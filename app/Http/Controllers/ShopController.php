<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Stancl\Tenancy\Facades\Tenancy;

class ShopController extends Controller
{
    public function index()
    {
        $datas = Shop::where('merchant_id', Auth::id())->get();
        return view('merchant.shop.index', compact('datas'));
    }
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:shops,name']);
        $tenant = Tenant::create([
            'id'=>$request->name,
        ]);
        $tenant->domains()->create([
            'domain'=>$request->name.'.localhost',
        ]);

        Shop::create([
            'merchant_id' => Auth::id(),
            'name' => $request->name,
            'tenant_id'=> $tenant->id
        ]);

        return redirect()->route('shop.index')->with('success', 'Shop Created Successfully!');
    }


    public function showcategory(){
        $tenant = tenancy()->tenant; 
        if (!$tenant) {
            abort(404, 'Shop not found');
        }
        $shop = Shop::where('name', $tenant->id)->first();
        if(!$shop){
            abort(404, 'Shop not found');
        }
        $categories = Category::where('shop_id', $shop->id)->get();
        return view('merchant.shop.showcategory', compact('categories'));
    }
    public function getProducts($categoryId)
    {
        $tenant = tenancy()->tenant;
        if (!$tenant) {
            return response()->json(['error' => 'Shop not found'], 404);
        }
        $products = Product::where('category_id', $categoryId)
            ->get();

        return response()->json($products);
    }
}

