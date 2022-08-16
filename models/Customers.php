<?php

namespace app\models;

use Yii;
use yii\validators\EmailValidator;
use yii\validators\NumberValidator;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $second_name
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $email
 * @property int|null $status
 * @property int|null $parent_id
 * @property string|null $description
 * @property int|null $created
 * @property int|null $modified
 */
class Customers extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'parent_id', 'created', 'modified'], 'integer'],
            [['first_name', 'second_name'], 'string', 'max' => 50],
            [['phone', 'email'], 'string', 'max' => 100],
            [['address', 'description'], 'string', 'max' => 255],
            ['email', 'checkCustomerEmailList'],
            ['phone', 'checkCustomerPhoneList']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'second_name' => 'Second Name',
            'phone' => 'Phone',
            'address' => 'Address',
            'email' => 'Email',
            'status' => 'Status',
            'parent_id' => 'Parent ID',
            'description' => 'Description',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    /**
     * @param $attribute
     */
    public function checkCustomerEmailList($attribute)
    {
        $validator = new EmailValidator;
        $emails = is_array($this->email)? : explode(', ', $this->email);

        foreach ($emails as $email) {
            $validator->validate($email)? : $this->addError($attribute, $email . " is not a valid email.");
        }
    }

    /**
     * @param $attribute
     */
    public function checkCustomerPhoneList($attribute)
    {
        $validator = new NumberValidator();
        $phones = is_array($this->phone)? : explode(', ', $this->phone);

        foreach ($phones as $phone) {
            $validator->validate($phone)? : $this->addError($attribute, $phone . " is not a valid phone.");
        }
    }
}
