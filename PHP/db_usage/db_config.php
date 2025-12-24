<?php
function getDbConfig($env = 'test') {
    $configs = [
        'test' => [
            'host' => 'dev-hostname',
            'port' => 3306,
            'username' => 'user_dev',
            'password' => 'dev-password',
            'dbname' => 'DB-dev',
        ],
        'prod' => [
            'host' => 'prod-hostname',
            'port' => 3306,
            'username' => 'user_prod',
            'password' => 'prod-password',
            'dbname' => 'DB-prod',
        ],
    ];

    return $configs[$env] ?? $configs['test'];
}
