<?php

namespace PhpOn\ApolloYii;

class Apollo
{
    public static function __callStatic($method, $arguments)
    {
        return self::getConfigReader()->$method(...$arguments);
    }

    private static function getConfigReader()
    {
        $hasObj = \Yii::$container->has('configreader');
        if (!$hasObj) {
            self::setConfigReader();
            return \Yii::$container->get('configreader');
        } else {
            return \Yii::$container->get('configreader');
        }

    }

    private static function setConfigReader()
    {
        \Yii::$container->setSingleton('configreader', [
            'class' => 'PhpOn\ApolloYii\ConfigReader',
            'dir' => '@apolloPath'
        ]);
    }

}