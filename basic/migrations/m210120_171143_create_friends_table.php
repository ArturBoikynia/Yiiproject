<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%friends}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%yiiusers}}`
 * - `{{%yiiusers}}`
 */
class m210120_171143_create_friends_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%friends}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'friend_id' => $this->integer()->notNull(),
            'username' => $this->string(255)->notNull(),
            'created_at' => $this->dateTime()->notNull()->defaultValue(new Expression('CURRENT_TIMESTAMP')),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-friends-user_id}}',
            '{{%friends}}',
            'user_id'
        );

        // add foreign key for table `{{%yiiusers}}`
        $this->addForeignKey(
            '{{%fk-friends-user_id}}',
            '{{%friends}}',
            'user_id',
            '{{%yiiusers}}',
            'id',
            'CASCADE'
        );

        // creates index for column `friend_id`
        $this->createIndex(
            '{{%idx-friends-friend_id}}',
            '{{%friends}}',
            'friend_id'
        );

        // add foreign key for table `{{%yiiusers}}`
        $this->addForeignKey(
            '{{%fk-friends-friend_id}}',
            '{{%friends}}',
            'friend_id',
            '{{%yiiusers}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%yiiusers}}`
        $this->dropForeignKey(
            '{{%fk-friends-user_id}}',
            '{{%friends}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-friends-user_id}}',
            '{{%friends}}'
        );

        // drops foreign key for table `{{%yiiusers}}`
        $this->dropForeignKey(
            '{{%fk-friends-friend_id}}',
            '{{%friends}}'
        );

        // drops index for column `friend_id`
        $this->dropIndex(
            '{{%idx-friends-friend_id}}',
            '{{%friends}}'
        );

        $this->dropTable('{{%friends}}');
    }
}
