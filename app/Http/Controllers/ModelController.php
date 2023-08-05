<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Banners;
use Mockery\Undefined;
use PhpParser\Builder\Function_;
use PhpParser\Node\Stmt\Return_;

class ModelController extends Controller
{
    // private $payment;

    public function __construct(\App\Services\PaymentInterface $payment)
    {
        // $this->payment = $payment;
    }


    public function TEST()
    {
        return 'done';
    }

    public function index(Request $request)
    {
        $array = [
            4,
            1 + 4 => "A",
            "@" => "@",
        ];
        //

        return ;
    }

    public function create(Request $request)
    {
        return $this->payment->show();
    }
}
// commit deploy da fix het loi