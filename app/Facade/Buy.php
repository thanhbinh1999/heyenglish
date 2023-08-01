<?php

namespace App\Facade;

use App\Facade\Order;
use App\Facade\Shipping;

class Buy
{
    private $order;

    private $shipping;

    private static $instance;

    public function __construct(Order $order = null, Shipping $shipping = null)
    {
        $this->order = $order ?? new order();
        $this->shipping = $shipping ?? new Shipping();
    }

    public static function getInstance()
    {
        if (static::$instance == null) {
            static::$instance =  (new static);
        }

        return static::$instance;
    }

    public function order()
    {
        $this->order->sendMail('lebinh23091999@gmail.com');
        $this->order->discount(100);
        $this->shipping->package();
    }
}
