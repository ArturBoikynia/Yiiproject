<?php

return [
    'color' => null,
    'interactive' => true,
    'help' => null,
    'sourcePath' => '@app',
    'languages' => ['ru-RU'],
    'translator' => 'Yii::t',
    'sort' => false,
    'overwrite' => true,
    'removeUnused' => true,
    'markUnused' => false,
    'except' => [
        '@yii/messages',
        '@yii/BaseYii.php',
        '/vendor',
    ],
    'only' => [
        '*.php',
    ],
    'format' => 'db',
    'db' => 'db',
    'ignoreCategories' => [
        'yii',
    ],
];