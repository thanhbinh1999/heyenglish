<?php

namespace App\Proxy;

use App\Proxy\ImageInterface;

class Image implements ImageInterface
{
    /**
     * @var string $image
     */
    private $image;

    public function setLink(string $image): void
    {
        $this->image = $image;
    }

    public function getImage(): string
    {
        return $this->image;
    }
}
