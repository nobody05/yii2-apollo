<?php

namespace PhpOn\ApolloYii\commands;

use Org\Multilinguals\Apollo\Client\ApolloClient;
use yii\console\Controller;
use yii\helpers\BaseFileHelper;


class ApolloClientController extends Controller
{
    public $namespaces;
    public $cluster;
    public $save_dir;
    public $config_server;
    public $app_id;
    public $timeout_interval;

    /**
     * apollo-client
     *
     * @throws \Exception
     */
    public function actionIndex() :void
    {
        $this->paramsFilters();
        try {
            $this->initClient()->start();
        } catch (\Exception $e) {
            throw new \Exception("apollo client start failed: ". $e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    protected function paramsFilters() :void
    {
        if (empty($this->config_server)) throw new \Exception("ConfigServer must be specified!");
        if (empty($this->app_id)) throw new \Exception("AppId must be specified!");

        if (empty($this->namespaces)) {
            $this->namespaces = ['application'];
        } else {
            $this->namespaces = array_map(function($namespace){
                return trim($namespace);
            }, $this->namespaces);
        }

        if (!file_exists(\Yii::getAlias($this->save_dir))) {
            BaseFileHelper::copyDirectory(__DIR__. '/../../storage/', \Yii::getAlias("@storagePath"));
        }
    }

    protected function initClient() :ApolloClient
    {
        $apolloClient = new ApolloClient($this->config_server, $this->app_id, $this->namespaces);
        $apolloClient->setIntervalTimeout($this->timeout_interval);
        $apolloClient->setSaveDir(\Yii::getAlias($this->save_dir));

        return $apolloClient;
    }

}