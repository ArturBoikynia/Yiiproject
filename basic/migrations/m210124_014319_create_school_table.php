<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%school}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%yiiusers}}`
 */
class m210124_014319_create_school_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%school}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'nameOfSchool' => $this->string(255)->notNull(),
            'place' => $this->string(255)->notNull(),
            'specialty' => $this->string(255)->defaultValue(NULL),
            'begin' => $this->date()->defaultValue(NULL),
            'end' => $this->date()->defaultValue(NULL),
            'to_this_day' => $this->boolean()->defaultValue(false),
            'created_at' => $this->timestamp()->notNull()->defaultValue(new Expression('CURRENT_TIMESTAMP')),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-school-user_id}}',
            '{{%school}}',
            'user_id'
        );

        // add foreign key for table `{{%yiiusers}}`
        $this->addForeignKey(
            '{{%fk-school-user_id}}',
            '{{%school}}',
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
            '{{%fk-school-user_id}}',
            '{{%school}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-school-user_id}}',
            '{{%school}}'
        );

        $this->dropTable('{{%school}}');
    }
}
