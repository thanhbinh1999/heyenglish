<?php

namespace App\Factory;

interface Logger
{
    /**
     * @param string $messages
     * @return void
     */
    public function log(string $messages): void;
}
