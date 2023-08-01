<?php

namespace App\Builder;

interface HeroBuilder
{
    /**
     * @param string $color
     * @param string $hair
     * @return void
     */
    public function  createBody(string $color, string $hair): void;

    /**
     * @return mixed
     */
    public function getHero();
}
