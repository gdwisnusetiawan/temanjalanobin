<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index($category)
    {
        $title = str_replace('-', ' ', $category);
        $category = Category::where('title', $title)->first();
        $products = $category->products;

        return view('shop.index', compact('category', 'products'));
    }

    public function single($category, $product)
    {
        $title = str_replace('-', ' ', $product);
        $product = Product::whereRaw("LOWER(title) = '$title'")->first();
        if(!isset($product)) {
            request()->session()->flash('notify', ['message' => 'Product doesn\'t exists', 'type' => 'danger']);
            return redirect()->route('shop.index', [$category, $product]);
        }
        return view('shop.single', compact('product'));
    }

    public function singleAjax()
    {
        return view('shop.single-ajax');
    }

    public function cart(Request $request)
    {
        // $cart = $request->cart ?? $request->keys()[0] ?? false;
        
    }

    public function checkout(Request $request)
    {
        $checkout = $request->checkout ?? $request->keys()[0] ?? false;
        return view('shop.checkout', compact('checkout'));
    }
}
