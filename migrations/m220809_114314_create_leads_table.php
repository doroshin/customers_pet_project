<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%leads}}`.
 */
class m220809_114314_create_leads_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%leads}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(50)->null(),
            'second_name' => $this->string(50)->null(),
            'phone' => $this->string(100)->null(),
            'address' => $this->string(255)->null(),
            'email' => $this->string(100)->null(),
            'status' => $this->integer(1)->null()->defaultValue(0),
            'description' => $this->string(255)->null(),
            'created' => $this->integer(11)->null(),
            'modified' => $this->integer(11)->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%leads}}');
    }
}
