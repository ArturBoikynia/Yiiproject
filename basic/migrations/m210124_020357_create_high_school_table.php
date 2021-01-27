<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%high_school}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%yiiusers}}`
 */
class m210124_020357_create_high_school_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%high_school}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'place' => $this->string(255)->notNull(),
            'nameOfUni' => $this->string(255)->notNull(),
            'specialty' => $this->string(255)->defaultValue(NULL),
            'faculty' => $this->string(255)->defaultValue(NULL),
            'departament' => $this->string(255)->defaultValue(NULL),
            'degree' => $this->string(255)->defaultValue(NULL),
            'begin' => $this->date()->defaultValue(NULL),
            'end' => $this->date()->defaultValue(NULL),
            'to_this_day' => $this->boolean()->defaultValue(false),
            'created_at' => $this->timestamp()->notNull()->defaultValue(new Expression('CURRENT_TIMESTAMP')),

        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-high_school-user_id}}',
            '{{%high_school}}',
            'user_id'
        );

        // add foreign key for table `{{%yiiusers}}`
        $this->addForeignKey(
            '{{%fk-high_school-user_id}}',
            '{{%high_school}}',
            'user_id',
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
            '{{%fk-high_school-user_id}}',
            '{{%high_school}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-high_school-user_id}}',
            '{{%high_school}}'
        );

        $this->dropTable('{{%high_school}}');
    }
}
