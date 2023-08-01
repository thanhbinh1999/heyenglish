<?php

namespace App\Builder;

use App\Builder\HeroBuilder;
use Attribute;

class InvokeBuilder implements HeroBuilder
{

    private $attr = [];

    /**
     * @param string $color
     * @param strign $hairI
     * @return void
     */
    public function createBody(string $color, string $hair): void
    {
        $this->attr['color'] = $color;

        $this->attr['hair'] = $hair;
    }

    /**
     * @return mixed
     */
    public function getHero()
    {
        return $this->attr;
    }
}
