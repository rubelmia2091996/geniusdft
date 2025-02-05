<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class MerchantController extends Controller
{
    public function dashboard()
    {
        $shops = Shop::where('merchant_id', Auth::id())->get();
        return view('merchant.dashboard', compact('shops'));
    }
}
