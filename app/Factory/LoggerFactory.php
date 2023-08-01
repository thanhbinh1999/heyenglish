<?php

namespace App\Factory;

interface LoggerFactory
{
    /**
     * @param stirng $type
     */
    public function createLogger(string $type = null);
}
