<?php

namespace App\Builder;

use App\Builder\HeroBuilder;
use Illuminate\Database\Eloquent\Builder;

interface HeroBuilderInterface
{
    public function setBuilder(HeroBuilder $heroBuilder);

    public function buildHero();
}

class HeroBuilderDirector implements HeroBuilderInterface
{
    private static $builder;

    public static function __callStatic($name, $arguments)
    {
        return $name(...$arguments);
    }

    public function setBuilder(HeroBuilder $builder)
    {
        static::$builder = $builder;

        return static::class;
    }

    public function buildHero()
    {
        return $this->builder->getHero();
    }
}
