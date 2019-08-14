## yii2-apollo client

### Instruction

* install 

```bash
composer require phpno/yii2-apollo
```    
* change .env file

```dotenv
APP_ID=1
CLUSTER=default
APOLLO_NAMESPACES="application,hogwarts.common_snape_config"
APOLLO_COMMON_NAMESPACE="hogwarts.common_snape_config"
APOLLO_CONFIG_SERVER=127.0.0.1

```
* add configuration in console.php & web.php 

```php
[
    'aliases' => [
        '@storagePath' => '@app/storage',
        '@apolloPath' => '@storagePath/apollo'
    ]
];
```
        
* add configuration in console.php 
        
```php
[
    'controllerMap' => [
        'apollo.start-agent' => [
            'class' => 'Wby\ApolloYii\commands\ApolloClientController',
            'namespaces' => explode(',', getenv('APOLLO_NAMESPACES', 'application')),
            'cluster' => getenv('APOLLO_CLUSTER', 'default'),
            'save_dir' => '@apolloPath',
            'config_server' => getenv('APOLLO_CONFIG_SERVER', 'http://192.168.100.184:8090'),
            'app_id' => getenv('APP_ID'),
            'timeout_interval' => 70
        ]
    ]
];
    
```
    
### use

* exec ./yii apollo.start-agent , if you want to keep the script run in daemon can see http://supervisord.org/
* how get config 

```php
$namespace = 'application';
$key = 'host';
$host = Apollo::connect($namespace)->get($key);

```