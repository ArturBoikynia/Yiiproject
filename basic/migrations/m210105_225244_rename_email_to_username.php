<?php

use yii\db\Migration;

/**
 * Class m210105_225244_rename_email_to_username
 */
class m210105_225244_rename_email_to_username extends Migration
{
    /**artur_shop@localhost [2]
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%yiiusers}}', 'email', 'username');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%yiiusers}}','username', 'email');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210105_225244_rename_email_to_username cannot be reverted.\n";

        return false;
    }
    */
}
