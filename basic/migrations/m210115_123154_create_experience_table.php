<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%experience}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%yiiusers}}`
 */
class m210115_123154_create_experience_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%experience}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'company' => $this->string(255)->notNull(),
            'post' => $this->string(255)->notNull(),
            'areaOfEmployment' => $this->string(3000)->notNull(),
            'from' => $this->date()->defaultValue(NULL),
            'to' => $this->date()->defaultValue(NULL),
            'to_this_day' => $this->boolean()->defaultValue(false),
            'created_at' => $this->timestamp()->notNull()->defaultValue(new Expression('CURRENT_TIMESTAMP')),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-experience-user_id}}',
            '{{%experience}}',
            'user_id'
        );

        // add foreign key for table `{{%yiiusers}}`
        $this->addForeignKey(
            '{{%fk-experience-user_id}}',
            '{{%experience}}',
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
            '{{%fk-experience-user_id}}',
            '{{%experience}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-experience-user_id}}',
            '{{%experience}}'
        );

        $this->dropTable('{{%experience}}');
    }
}
