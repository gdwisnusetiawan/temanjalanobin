<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Product;
use App\Promotion;
use App\Flashsale;
use App\Flashsaleproduct;
use App\Singleblock;
use App\Partner;
use App\Subpartner;
use App\Testimonial;
use App\Subtestimonial;
use App\Video;
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
        // http error
        // abort(404);
        $sliders = Slider::all();
        $products = Product::where('special', true)->get();
        $top_rateds = Product::inRandomOrder()->limit(3)->get();
        $on_sales = Product::inRandomOrder()->limit(3)->get();
        $recommendeds = Product::inRandomOrder()->limit(3)->get();
        $populars = Product::inRandomOrder()->limit(3)->get();
        $promotion = Promotion::first();
        $flashsale = Flashsale::first();
        // $flashsale = Flashsaleproduct::all();
        $singleblock = Singleblock::first();
        $testimonial = Testimonial::first();
        $partner = Partner::first();
        $subpartners = Subpartner::all();
        $subtestimonials = Subtestimonial::limit($testimonial->total)->get();
        if($testimonial->random) {
            $subtestimonials_count = Subtestimonial::all()->count();
            $testimonial_total = $testimonial->total;
            if($subtestimonials_count < $testimonial->total) {
                $testimonial_total = $subtestimonials_count;
            }
            $subtestimonials = Subtestimonial::all()->random($testimonial_total);
        }
        $videos = Video::all();

        // dd($top_rateds[0]->media['url'][0]);

        return view('home', compact(
            'sliders', 
            'products', 
            'top_rateds', 
            'on_sales', 
            'recommendeds', 
            'populars', 
            'promotion', 
            'flashsale', 
            'singleblock',
            'partner',
            'subpartners',
            'testimonial',
            'subtestimonials',
            'videos'
        ));
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
