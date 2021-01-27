<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%programminglanguages}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%yiiusers}}`
 */
class m210102_175518_create_programminglanguages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%programminglanguages}}', [
            'user_id' => $this->integer()->notNull()->unique(),
            'c' => $this->boolean()->notNull()->defaultValue(false),
            'cPlus' => $this->boolean()->notNull()->defaultValue(false),
            'cSharp' => $this->boolean()->notNull()->defaultValue(false),
            'go' => $this->boolean()->notNull()->defaultValue(false),
            'java' => $this->boolean()->notNull()->defaultValue(false),
            'javaScript' => $this->boolean()->notNull()->defaultValue(false),
            'matlab' => $this->boolean()->notNull()->defaultValue(false),
            'objectiveC' => $this->boolean()->notNull()->defaultValue(false),
            'perl' => $this->boolean()->notNull()->defaultValue(false),
            'pascal' => $this->boolean()->notNull()->defaultValue(false),
            'php' => $this->boolean()->notNull()->defaultValue(false),
            'python' => $this->boolean()->notNull()->defaultValue(false),
            'r' => $this->boolean()->notNull()->defaultValue(false),
            'sql' => $this->boolean()->notNull()->defaultValue(false),
            'created_at' => $this->timestamp()->notNull()->defaultValue(new Expression('CURRENT_TIMESTAMP')),
            'updated_at' => $this->timestamp()->defaultValue(NULL)->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-programminglanguages-user_id}}',
            '{{%programminglanguages}}',
            'user_id'
        );

        // add foreign key for table `{{%yiiusers}}`
        $this->addForeignKey(
            '{{%fk-programminglanguages-user_id}}',
            '{{%programminglanguages}}',
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
            '{{%fk-programminglanguages-user_id}}',
            '{{%programminglanguages}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-programminglanguages-user_id}}',
            '{{%programminglanguages}}'
        );

        $this->dropTable('{{%programminglanguages}}');
    }
}
