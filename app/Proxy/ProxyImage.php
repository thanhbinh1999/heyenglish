<?php

namespace App\Proxy;

use App\Proxy\ImageInterface;
use Exception;

class ProxyImage
{
    /**
     * @var  $imageService
     */
    private  static $imageService;

    /**
     * @var $imageUrl
     */
    private $imageUrl;

    private $isAdmin = false;


    public static function bindSevice(ImageInterface $imageService)
    {
        if (static::$imageService == null) {
            static::$imageService  = $imageService;
        }

        return (new static);
    }

    public function __call($method, $arguments)
    {
        if ($this->isAdmin) {
            static::$imageService->$method(...$arguments);
        } else {
            throw new Exception('page not found');
        }
    }

    public function getImage(): string
    {
        return file_get_contents(
            static::$imageService->getImage($this->imageUrl)
        );
    }

    public function isAdmin()
    {
        $this->isAdmin  = true;
        return $this;
    }
}
