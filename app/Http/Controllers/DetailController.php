<?php

namespace App\Http\Controllers;

use App\TransactionDetail;
use App\TravelPackage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function index(Request $request, $slug)
    {
        $item = TravelPackage::with(['galleries', 'transactions'])
            ->where('slug', $slug)->firstOrFail();

        Auth::check()
            ? $user_id = Auth::user()->id
            : $user_id = 0;

        $status = $item->transactions()->where('user_id', $user_id)->where('transaction_status', 'IN_CART')->first();

        $detail = 0;
        if ($status) {
            $detail = TransactionDetail::where('transaction_id', $status->id)->count();
        }

        $members_going = $this->member_going($slug);

        return view('pages.detail', [
            'item' => $item,
            'members_going' => $members_going,
            'status' => $status,
            'detail' => $detail
        ]);
    }

    public function member_going($slug)
    {
        $item = TravelPackage::with(['galleries', 'transactions'])
            ->where('slug', $slug)->firstOrFail();

        $sukses = $item->transactions()->whereIn('transaction_status', ['PENDING', 'SUCCESS'])->get();

        $member = collect();
        $all_user = collect();
        if ($sukses->count()) {
            foreach ($sukses as $sukses_tunggal) {
                $members_going = TransactionDetail::where('transaction_id', $sukses_tunggal->id)->first();
                $member->push($members_going);
            }

            foreach ($member as $user_detail) {
                $user_detail = User::where('username', $user_detail->username)->first();
                $all_user->push($user_detail);
            }

            $all_user = $all_user->unique('id')->values();
        }

        return $all_user;
    }
}
