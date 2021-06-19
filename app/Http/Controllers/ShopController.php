<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Helpers\Functions;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index($category)
    {
        $title = str_replace('-', ' ', $category);
        // $category = Category::whereRaw("LOWER(title) = '$title'")->first();
        $category = Category::where('slug', 'like', '%'.$category.'%')->first();
        $products = $category->products;

        // dd($products->where('slug', 'bali')->first()->rating_avg);

        return view('shop.index', compact('category', 'products'));
    }

    public function single($category, $product)
    {
        $title = str_replace('-', ' ', $product);
        $category_title = str_replace('-', ' ', $category);
        // $product = Product::with('variants')->whereRaw("LOWER(title) = '$title'")->first();
        $product = Product::with('variants')->where('slug', 'like', '%'.$product.'%')->first();
        $category = Category::where('slug', 'like', '%'.$category.'%')->first();
        if(!isset($product)) {
            request()->session()->flash('notify', ['message' => 'Product doesn\'t exists', 'type' => 'danger']);
            return redirect()->route('shop.index', [$category, $product]);
        }
        $variants = $product->variants;
        $relateds = Product::where('category', $category->id)->where('id', '!=', $product->id)->limit(9)->get();
        // dd($product->category_model);
        return view('shop.single', compact('product', 'variants', 'relateds'));
    }

    public function singleAjax()
    {
        return view('shop.single-ajax');
    }

    public function checkout(Request $request)
    {
        $checkout = $request->checkout ?? $request->keys()[0] ?? false;
        return view('shop.checkout', compact('checkout'));
    }

    public function pricing(Request $request, $id)
    {
        $price = Product::find($id)->getUserPrice($request->quantity);
        $totalPrice = $price * $request->quantity;
        $priceFormatted = Functions::currencyConvert($totalPrice);
        // $price = Product::find($id)->getUserPrice(11);
        return response()->json($priceFormatted);
    }
}
