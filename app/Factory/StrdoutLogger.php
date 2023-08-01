<?php

namespace App\Factory;

use App\Factory\Logger;

class StrdoutLogger implements Logger
{
    /**
     * @var string $path
     * @return void
     */
    private $path;

    public function __construct(string $path = null)
    {
        $this->path  = $path;
    }

    /**
     * @param string $message
     * @return void
     */
    public function log(string $message): void
    {
        echo __CLASS__ . '/' . $message;
    }
}
