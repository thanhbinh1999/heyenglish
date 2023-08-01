<?php

namespace App\Factory;

use App\Factory\Logger;

class StrdoutFile implements Logger
{
    public function log(string $messages): void
    {
        echo  __CLASS__ . '/' . $messages;
    }
}
