<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%photo}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%yiiusers}}`
 */
class m210107_224006_create_photo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%photo}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'path' => $this->string(255)->notNull()->unique(),
            'is_main' => $this->boolean()->notNull()->defaultValue(false),
            'created_at' => $this->timestamp()->defaultValue(new Expression('CURRENT_TIMESTAMP')),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-photo-user_id}}',
            '{{%photo}}',
            'user_id'
        );

        // add foreign key for table `{{%yiiusers}}`
        $this->addForeignKey(
            '{{%fk-photo-user_id}}',
            '{{%photo}}',
            'user_id',
            '{{%yiiusers}}',
            'id',
            'CASCADE',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%yiiusers}}`
        $this->dropForeignKey(
            '{{%fk-photo-user_id}}',
            '{{%photo}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-photo-user_id}}',
            '{{%photo}}'
        );

        $this->dropTable('{{%photo}}');
    }
}
