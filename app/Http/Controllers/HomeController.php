<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Product;
use App\User;
use App\Helpers\Functions;
use Illuminate\Http\Request;

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
    public function index()
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
}
