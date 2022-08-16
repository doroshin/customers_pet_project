<?php

namespace app\models;

use Yii;
use yii\validators\EmailValidator;
use yii\validators\NumberValidator;
use yii\validators\Phone;

/**
 * This is the model class for table "leads".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $second_name
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $email
 * @property int|null $status
 * @property string|null $description
 * @property int|null $created
 * @property int|null $modified
 */
class Leads extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'leads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created', 'modified'], 'integer'],
            [['first_name', 'second_name'], 'string', 'max' => 50],
            [['phone', 'email'], 'string', 'max' => 100],
            [['address', 'description'], 'string', 'max' => 255],
            [['first_name', 'second_name', 'phone', 'address', 'email'], 'required'],
            ['email', 'checkEmailList'],
            ['phone', 'checkPhoneList']
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
            'description' => 'Description',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    public static function statuses()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
        ];
    }

    /**
     * @param $attribute
     */
    public function checkEmailList($attribute)
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
    public function checkPhoneList($attribute)
    {
        $validator = new NumberValidator();
        $phones = is_array($this->phone)? : explode(', ', $this->phone);

        foreach ($phones as $phone) {
            $validator->validate($phone)? : $this->addError($attribute, $phone . " is not a valid phone.");
        }
    }
}
