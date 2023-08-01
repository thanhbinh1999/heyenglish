<?php

namespace App\Adapter;

class MomoAdapter
{
    private $momo = '';

    public function __construct(Momo $momo)
    {
        $this->momo = $momo;
    }

    public function payment()
    {
        return $this->toVisa($this->momo->getInfo());
    }

    public function toVisa($momoData)
    {
        $visaData = ['current_session' => 10];

        return array_merge($momoData, $visaData);
    }
}
