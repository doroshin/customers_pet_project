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
            'first_name' => $this->string(50),
            'second_name' => $this->string(50),
            'phone' => $this->string(100),
            'address' => $this->string(255),
            'email' => $this->string(100),
            'status' => $this->integer(1)->null()->defaultValue(0),
            'description' => $this->string(255),
            'created_at' => $this->integer(11)->notNull(),
            'modified_at' => $this->integer(11)
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
