<?php

namespace App\Singleton;

class Database
{

    private static $singleton =  null;

    public static function getInstance()
    {
        if (static::$singleton == null) {
            static::$singleton = new Mysql();
            \Log::info(time());
        }
        return static::$singleton;
    }
}

class Mysql
{
    public function getConn()
    {
        return 'mysql connecting';
    }
}
