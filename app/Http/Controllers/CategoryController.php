<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $shops = Shop::where('merchant_id', Auth::id())->pluck('id')->toArray();
        $datas = Category::whereIn('shop_id', $shops)->with('shop')->get();
        $stores = Shop::where('merchant_id', Auth::id())->get();
        return view('merchant.category.index', compact('datas','stores'));

    }
    public function store(Request $request)
    {
        $request->validate([
            'store_id'=> 'required',
            'name' => 'required|string|max:255'
        ]);

        Category::create([
            'shop_id' => $request->store_id,
            'name' => $request->name,
        ]);

        return redirect()->route('category.index')->with('success', 'Shop Created Successfully!');
    }
}
