<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Product;
use App\User;
use App\Currency;
use App\Helpers\Functions;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Cookie::queue(Cookie::forget('currency'));
        // dd(Cookie::get('currency'));
        $customers = User::all();
        foreach($customers as $customer) {
            if($customer->email_verified_at == null && $customer->status) {
                $customer->email_verified_at = date('Y-m-d H:i:s');
                $customer->save();
            }
        }
        // http error
        // abort(404);
        $sliders = Slider::all();
        $products = Product::where('special', true)->get();
        $top_rateds = Product::inRandomOrder()->limit(3)->get();
        $on_sales = Product::inRandomOrder()->limit(3)->get();
        $recommendeds = Product::inRandomOrder()->limit(3)->get();
        $populars = Product::inRandomOrder()->limit(3)->get();

        // dd((asset('/img/'.$products[0]->image1)));

        return view('home', compact('sliders', 'products', 'top_rateds', 'on_sales', 'recommendeds', 'populars'));
    }

    // public function welcome()
    // {
    //     return view('welcome');
    // }

    // public function dashboard()
    // {
    //     return view('dashboard');
    // }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function faq()
    {
        return view('faq');
    }

    public function distributor()
    {
        return view('distributor');
    }

    public function currency(Request $request)
    {
        $currency = Currency::find($request->id);
        $currency = $currency == null ? Currency::first() : $currency;
        return response()->json($currency);
    }

    public function convertCurrency(Request $request)
    {
        $converted = Functions::currencyConvert($request->value, $request->origin ?? 'Rp');
        return response()->json($converted);
    }

    public function setCookie(Request $request){
        // Cookie::queue(Cookie::forget($request->key));
        // return (Cookie::get('currency'));
        $response = new Response('Hello World');
        $response->withCookie(cookie()->forever($request->key, $request->value));
        // return $request->cookie($request->key);
        return $response;
    }

    public function getCookie(Request $request){
        $value = $request->cookie($request->key);
        return $value;
    }
}
