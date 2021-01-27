<?php

use yii\db\Migration;

/**
 * Class m210103_211615_add_access_rules
 */
class m210103_211615_add_access_rules extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $user = $auth->createRole('user');
        $admin = $auth->createRole('admin');

        $logout = $auth->createPermission('logout');
        $login = $auth->createPermission('login');
        $view = $auth->createPermission('view');
        $update = $auth->createPermission('update');
        $create = $auth->createPermission('create');
        $delete = $auth->createPermission('delete');

        $auth->add($logout);
        $auth->add($login);
        $auth->add($view);
        $auth->add($update);
        $auth->add($create);
        $auth->add($delete);


        $auth->add($user);
        $auth->add($admin);



        $auth->addChild($user, $view);
        $auth->addChild($user, $logout);

        $auth->addChild($admin, $user);
        $auth->addChild($admin, $update);
        $auth->addChild($admin, $create);
        $auth->addChild($admin, $delete);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $user = $auth->createRole('user');
        $admin = $auth->createRole('admin');

        $login = $auth->createPermission('login');
        $logout = $auth->createPermission('logout');
        $view = $auth->createPermission('view');
        $update = $auth->createPermission('update');
        $create = $auth->createPermission('create');
        $delete = $auth->createPermission('delete');

        $auth->remove($login);
        $auth->remove($logout);
        $auth->remove($view);
        $auth->remove($update);
        $auth->remove($create);
        $auth->remove($delete);

        $auth->remove($user);
        $auth->remove($admin);


    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210103_211615_add_access_rules cannot be reverted.\n";

        return false;
    }
    */
}
