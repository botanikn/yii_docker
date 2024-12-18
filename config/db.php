<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=yii_db;port=5432;dbname=pet-project',
    'username' => 'u1',
    'password' => '12345',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
