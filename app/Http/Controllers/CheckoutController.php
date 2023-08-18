<?php

namespace App\Http\Controllers;

use App\Mail\TransactionSuccess;
use App\Transaction;
use App\TransactionDetail;
use App\TravelPackage;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use \Midtrans\Config;
use \Midtrans\Snap;


use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{
    // index
    public function index(Request $request, $id)
    {
        $item = Transaction::with(['details', 'travel_package', 'user'])->findOrFail($id);
        return view('pages.checkout', [
            'item' => $item,
        ]);
    }

    public function process(Request $request, $id)
    {
        $travel_package = TravelPackage::findOrFail($id);

        $transaction = Transaction::create([
            'travel_packages_id' => $id,
            'user_id' => Auth::user()->id,
            'additional_visa' => 0,
            'transaction_total' => $travel_package->price,
            'transaction_status' => 'IN_CART'
        ]);

        // dd($transaction);

        TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'username' => Auth::user()->username,
            'nationality' => 'ID',
            'is_visa' => false,
            'doe_passport' => Carbon::now()->addYear(5),
        ]);

        return redirect()->route('checkout', $transaction->id);
    }

    public function remove(Request $request, $detail_id)
    {
        $item = TransactionDetail::findOrFail($detail_id);
        // dd($item->transaction_id);
        $transaction = Transaction::with(['details', 'travel_package'])
            ->findOrFail($item->transaction_id);


        // dd($transaction);
        if ($item->is_visa) {
            $transaction->transaction_total -= 190;
            $transaction->additional_visa -= 190;
        }

        $transaction->transaction_total -= $transaction->travel_package->price;

        $transaction->save();
        $item->delete();

        return redirect()->route('checkout', $item->transaction_id);
    }

    public function create(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|exists:users,username',
            'is_visa' => 'required|boolean',
            'doe_passport' => 'required',
        ]);

        $data = $request->all();
        $data['transaction_id'] = $id;

        TransactionDetail::create($data);
        $transaction = Transaction::with(['travel_package'])->find($id);

        if ($request->is_visa) {
            $transaction->transaction_total += 190;
            $transaction->additional_visa += 190;
        }

        $transaction->transaction_total += $transaction->travel_package->price;

        $transaction->save();

        return redirect()->route('checkout', $id);
    }

    // success
    public function success(Request $request, $id)
    {
        $transaction = Transaction::with(['details', 'travel_package.galleries', 'user'])->findOrFail($id);
        $detail = $transaction->details->count();
        if ($detail == 0) {
            return back()->withError('Data tidak boleh kosong');
        }
        $transaction->transaction_status = 'PENDING';
        $transaction->save();


        // set konfig midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');
        Config::$clientKey = config('midtrans.clientKey');

        // buat array untuk dikirim ke midtrans
        $midtrans_params = [
            'transaction_details' => [
                'order_id' => 'Midtrans-' . $transaction->id,
                'gross_amount' => (int) $transaction->transaction_total,
            ],
            'customer_details' => [
                'first_name' => 'cutomer',
                'last_name' => $transaction->user->name,
                'email' => $transaction->user->email,
                'phone' => '08123456789'
            ],
            'enabled_payments' => ['gopay', 'bca_klikpay', 'bri_epay', 'bca_klikbca'],
            'vtweb' => []
        ];

        // ambil halaman payment midtrans
        try {
            $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;
            // $snapToken = Snap::getSnapToken($midtrans_params);
            // redirect ke halaman midtrans
            return redirect($paymentUrl);
            // echo "<script>window.location.href='" . $paymentUrl . "'</script>";
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        // kirim email ke user ke tiketnya 
        // Mail::to($transaction->user)->send(
        //     new TransactionSuccess($transaction)
        // );

        // return view('pages.success', [
        //     'client_key' => Config::$clientKey,
        //     'snap_token' => $snapToken
        // ]);
    }
}
