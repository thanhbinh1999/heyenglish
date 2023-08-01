<?php

namespace App\Proxy;

interface ImageInterface
{
    public function setLink(string $image): void;

    public function getImage(): string;
}
