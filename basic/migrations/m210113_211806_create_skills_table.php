<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%skills}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%yiiusers}}`
 */
class m210113_211806_create_skills_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%skills}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(255)->notNull(),
            'skill' => $this->string(255)->notNull(),
            'created_at' => $this->timestamp()->defaultValue(new Expression('CURRENT_TIMESTAMP')),
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            '{{%idx-skills-author_id}}',
            '{{%skills}}',
            'user_id'
        );

        // add foreign key for table `{{%yiiusers}}`
        $this->addForeignKey(
            '{{%fk-skills-author_id}}',
            '{{%skills}}',
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
            '{{%fk-skills-author_id}}',
            '{{%skills}}'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            '{{%idx-skills-author_id}}',
            '{{%skills}}'
        );

        $this->dropTable('{{%skills}}');
    }
}
