<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreProductShopifyCheckout;


class ProductsController extends Controller
{
    public function index(){
        
        $products = StoreProductShopifyCheckout::where('user_checkout_store_id', session('store_id'))->paginate(10);
        $count = StoreProductShopifyCheckout::where('user_checkout_store_id', session('store_id'))->count();

        return view('products.index', compact('products', 'count'));
    }
}
