<?php
use yii\db\Connection;

return [
    'class' => Connection::class,
    'dsn' => 'mysql:host=db;dbname=artur_shop',
    'username' => 'artur_base',
    'password' => 'artur_pwd',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
