<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    private $payment; private $name;

    public function __construct(\App\Services\PaymentInterface $payment)
    {
	    $this->payment = $payment;
	    $this->name = $name;y
		   

    }

    public function index()
    {
    }
}
