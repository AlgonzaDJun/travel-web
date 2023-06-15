<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // index
    public function index(Request $request)
    {
        return view('pages.checkout');
    }

    // success
    public function success(Request $request)
    {
        return view('pages.success');
    }
}
