<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlite:' . realpath(__DIR__."/../db") . "/cache.db",
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
