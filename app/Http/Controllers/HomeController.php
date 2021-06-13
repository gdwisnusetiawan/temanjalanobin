<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Product;
use App\User;
use App\Currency;
use App\Promotion;
use App\Flashsale;
use App\Flashsaleproduct;
use App\Singleblock;
use App\Partner;
use App\Subpartner;
use App\Testimonial;
use App\Subtestimonial;
use App\Video;
use App\Subcategory;
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
        // $customers = User::all();
        // foreach($customers as $customer) {
        //     if($customer->email_verified_at == null && $customer->status) {
        //         $customer->email_verified_at = date('Y-m-d H:i:s');
        //         $customer->save();
        //     }
        // }
        // http error
        // abort(404);

        $sliders = Slider::all();
        $products = Product::where('special', true)->get();
        $top_rateds = Product::inRandomOrder()->limit(3)->get();
        $on_sales = Product::inRandomOrder()->limit(3)->get();
        $recommendeds = Product::inRandomOrder()->limit(3)->get();
        $populars = Product::inRandomOrder()->limit(3)->get();
        $services = collect([]);

        return view('home', compact('sliders', 'products', 'top_rateds', 'on_sales', 'recommendeds', 'populars', 'services'));
        
        // $sliders = Slider::all();
        // $products = Product::where('special', true)->get();
        // $top_rateds = Product::inRandomOrder()->limit(3)->get();
        // $on_sales = Product::inRandomOrder()->limit(3)->get();
        // $recommendeds = Product::inRandomOrder()->limit(3)->get();
        // $populars = Product::inRandomOrder()->limit(3)->get();
        // $promotion = Promotion::first();
        // $flashsale = Flashsale::first();
        // $flashsaleproducts = Flashsaleproduct::all();
        // $singleblock = Singleblock::first();
        // $testimonial = Testimonial::first();
        // $partner = Partner::first();
        // $subpartners = Subpartner::all();
        // $subtestimonials = Subtestimonial::limit($testimonial->total)->get();
        // if($testimonial->random) {
        //     $subtestimonials_count = Subtestimonial::all()->count();
        //     $testimonial_total = $testimonial->total;
        //     if($subtestimonials_count < $testimonial->total) {
        //         $testimonial_total = $subtestimonials_count;
        //     }
        //     $subtestimonials = Subtestimonial::all()->random($testimonial_total);
        // }
        // $videos = Video::all();
        // $subcategories = Subcategory::all();

        // return view('home', compact(
        //     'sliders', 
        //     'products', 
        //     'top_rateds', 
        //     'on_sales', 
        //     'recommendeds', 
        //     'populars', 
        //     'promotion', 
        //     'flashsale', 
        //     'flashsaleproducts', 
        //     'singleblock',
        //     'partner',
        //     'subpartners',
        //     'testimonial',
        //     'subtestimonials',
        //     'videos',
        //     'subcategories'
        // ));
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
        $converted = Functions::currencyConvert($request->value, $request->origin ?? Currency::first()->symbol ?? 'Rp');
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
