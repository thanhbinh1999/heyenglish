<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    private $payment;

    public function __construct(\App\Services\PaymentInterface $payment)
    {
        $this->payment = $payment;
    }

    public function index()
    {
    }
}
