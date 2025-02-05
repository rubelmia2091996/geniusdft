<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $shops = Shop::where('merchant_id', Auth::id())->get();
        $merchantId = Auth::id();
        $datas = Product::whereHas('category.shop', function ($query) use ($merchantId) {
            $query->where('merchant_id', $merchantId);
        })->with(['category.shop'])->get();
        return view('merchant.product.index', compact('datas','shops'));

    }
    public function store(Request $request)
    {
        $request->validate([
            'category_id'=> 'required',
            'name' => 'required|string|max:255'
        ]);

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
        ]);

        return redirect()->route('product.index')->with('success', 'Shop Created Successfully!');
    }

    public function findcategory($shop_id){
        $categories = Category::where('shop_id', $shop_id)->get();
        return response()->json($categories);
    }
}
