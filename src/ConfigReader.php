<?php

namespace PhpOne\ApolloYii;

class ConfigReader
{
    protected $namespaces = [];
    public $dir;
    protected $dirSeted;


    public function __construct()
    {

    }

    public function connect($namespace = 'application') {
        $this->setDir();
        if (!isset($this->namespaces[$namespace])) {
            $this->namespaces[$namespace] = new PropertiesReader($this->dir, $namespace);
        }
        return $this->namespaces[$namespace];
    }


    /**
     * Dynamically pass methods to the default connection.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->connect()->$method(...$parameters);
    }

    protected function setDir()
    {
        if (!$this->dirSeted) {
            $this->dir = \Yii::getAlias($this->dir);
            $this->dirSeted = true;
        }
    }
}