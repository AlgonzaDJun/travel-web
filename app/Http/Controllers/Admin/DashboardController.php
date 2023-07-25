<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transaction;
use App\TravelPackage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $travel_package = TravelPackage::count();
        return view('pages.admin.dashboard', [
            'travel_package' => $travel_package,
            'transaction' => Transaction::count(),
            'transaction_pending' => Transaction::where('transaction_status', 'PENDING')->count(),
            'transaction_sukses' => Transaction::where('transaction_status', 'SUCCESS')->count(),
        ]);
    }
}
