<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%yiiusers}}`.
 */
class m201223_112016_create_yiiusers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%yiiusers}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string(100)->notNull()->unique(),
            'name' => $this->string(100)->notNull(),
            'surname' => $this->string(100)->notNull(),
            'password' => $this->string(255)->notNull(),
            'is_active' => $this->boolean()->notNull()->defaultValue(false),
            'created_at' => $this->timestamp()->notNull()->defaultValue(new Expression('CURRENT_TIMESTAMP')),
            'updated_at' => $this->timestamp()->defaultValue(NULL)->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%yiiusers}}');
    }
}

