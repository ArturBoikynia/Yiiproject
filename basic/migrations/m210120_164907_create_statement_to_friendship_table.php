<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%statement_to_friendship}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%yiiusers}}`
 * - `{{%yiiusers}}`
 */
class m210120_164907_create_statement_to_friendship_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%statement_to_friendship}}', [
            'id' => $this->primaryKey(),
            'user_ask_id' => $this->integer()->notNull(),
            'user_answer_id' => $this->integer()->notNull(),
            'ask' => $this->boolean()->notNull(),
            'answer' => $this->boolean()->defaultValue(false),
            'reject' => $this->boolean()->defaultValue(false),
            'created_at' => $this->dateTime()->notNull()->defaultValue(new Expression('CURRENT_TIMESTAMP')),
        ]);

        // creates index for column `user_ask_id`
        $this->createIndex(
            '{{%idx-statement_to_friendship-user_ask_id}}',
            '{{%statement_to_friendship}}',
            'user_ask_id'
        );

        // add foreign key for table `{{%yiiusers}}`
        $this->addForeignKey(
            '{{%fk-statement_to_friendship-user_ask_id}}',
            '{{%statement_to_friendship}}',
            'user_ask_id',
            '{{%yiiusers}}',
            'id',
            'CASCADE',
            'CASCADE'

        );

        // creates index for column `user_answer_id`
        $this->createIndex(
            '{{%idx-statement_to_friendship-user_answer_id}}',
            '{{%statement_to_friendship}}',
            'user_answer_id'
        );

        // add foreign key for table `{{%yiiusers}}`
        $this->addForeignKey(
            '{{%fk-statement_to_friendship-user_answer_id}}',
            '{{%statement_to_friendship}}',
            'user_answer_id',
            '{{%yiiusers}}',
            'id',
            'CASCADE',
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
            '{{%fk-statement_to_friendship-user_ask_id}}',
            '{{%statement_to_friendship}}'
        );

        // drops index for column `user_ask_id`
        $this->dropIndex(
            '{{%idx-statement_to_friendship-user_ask_id}}',
            '{{%statement_to_friendship}}'
        );

        // drops foreign key for table `{{%yiiusers}}`
        $this->dropForeignKey(
            '{{%fk-statement_to_friendship-user_answer_id}}',
            '{{%statement_to_friendship}}'
        );

        // drops index for column `user_answer_id`
        $this->dropIndex(
            '{{%idx-statement_to_friendship-user_answer_id}}',
            '{{%statement_to_friendship}}'
        );

        $this->dropTable('{{%statement_to_friendship}}');
    }
}
