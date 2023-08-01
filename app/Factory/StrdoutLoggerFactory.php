<?php

namespace App\Factory;

use App\Factory\LoggerFactory;

use App\Factory\StrdoutLogger;

use App\Factory\StrdoutFile;
use Psy\Exception\BreakException;

class  StrdoutLoggerFactory implements LoggerFactory
{
    /**
     * @var static $app
     */
    private static $app = [];

    /**
     * @return static new instance
     */
    public  function createLogger($type = null)
    {
        return $this->getInstance($type);
    }

    /**
     * @return Obj
     */
    private static function getInstance(string $type = null)
    {
        if (!static::$app == null) {
            return static::$app;
        }

        switch ($type) {
            case 'strLogger':
                static::$app = new  StrdoutLogger();
                break;
            case 'strFile':
                static::$app = new StrdoutFile();
                break;
            default:
                static::$app = new StrdoutFile();
        }

        return static::$app;
    }
}
