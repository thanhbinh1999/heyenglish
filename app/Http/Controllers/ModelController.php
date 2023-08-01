<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Banners;

class ModelController extends Controller
{
    private $payment;

    public function __construct(\App\Services\PaymentInterface $payment)
    {
        $this->payment = $payment;
    }

    public function index(Request $request)
    {
        $banners = \DB::table('currencies')
            ->simplePaginate(3);

        return view("user.user_list", compact('banners'));
    }

    public function create(Request $request)
    {
        return $this->payment->show();
    }
}
