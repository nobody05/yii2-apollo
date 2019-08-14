<?php


return [
    'class' => 'PhpOn/ApolloYii/commands/ApolloClientController',
    'namespaces' => explode(',', getenv('APOLLO_NAMESPACES', 'application')),
    'cluster' => getenv('APOLLO_CLUSTER', 'default'),
    'save_dir' => "@app/storage/apollo",
    'config_server' => getenv('APOLLO_CONFIG_SERVER', 'http://192.168.100.184:8090'),
    'app_id' => getenv('APP_ID'),
    'timeout_interval' => 70
];