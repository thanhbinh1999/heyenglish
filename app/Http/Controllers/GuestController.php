<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class GuestController extends Controller
{
    public function index()
    {
        $banners = \DB::table('banners')->paginate(2)->withQueryString();
        return view('guest.index', compact('banners'));
    }

    public function create()
    {
        return view('guest.create');
    }
}
