<?php

namespace App\Providers;

use App\Config;
use App\Currency;
use App\Footer;
use App\Category;
use App\Marquee;
use App\Popup;
use App\User;
use App\Ip;
use App\Helpers\Functions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cookie;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(env('REDIRECT_HTTPS') === true) {
            \URL::forceScheme('http');
        }

        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        $modal_type = null;
        $popup = null;
        $popup_check = null;
        $loader = null;
        $menus = collect([]);
        $config = null;
        $footer = null;
        $marquee = null;
        $categories = collect([]);
        $currencies = collect([]);
        $currency = null;

        try {
            $config = Config::where('is_active', true)->orderBy('id', 'desc')->first();

            $request = new Request();
            $currency = Currency::where('name', $request->cookie('currency'))->first();
            if($currency == null) {
                $currency = Currency::first();
                // $response = new Response('Hello World');
                // $response->withCookie(cookie()->forever('currency', $currency->name));
            }

            $modal_type = rand(0,7);
            $modal_type = 0;
            // $ip = Functions::getIp('203.78.117.178');
            $popup = Popup::where('is_active', true)->first();
            $popup_check = true;
            // if($ip != null && $popup != null) {
            //     if($popup->valid == 1) {
            //         if(strtolower($popup->filter) == strtolower($ip->city)) {
            //             $popup_check = true;
            //         }
            //     }
            //     elseif($popup->valid == 2) {
            //         if(strtolower($popup->filter) == strtolower($ip->regionname)) {
            //             $popup_check = true;
            //         }
            //     }
            //     if($popup->valid == 3) {
            //         if(strtolower($popup->filter) == strtolower($ip->country)) {
            //             $popup_check = true;
            //         }
            //     }
            // }
            $loader = 2;
            $menus = Functions::menu();
            // $footer = Footer::where('is_active', true)->orderBy('id', 'desc')->first();
            $footer = Footer::orderBy('id', 'desc')->first();
            $marquee = Marquee::where('is_active', true)->first();
            $categories = Category::orderBy('id')->get();
            $user_referer = User::whereNotNull('referalid')->where('referalid', request()->get('referal'))->first();
            $currencies = Currency::all();
        } catch (\Exception $e) {
            // die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }
        // dd($menus[1][1]->isContains('title', ['belanja', 'shop', 'categories']));
        
        if($config == null || $config->is_active == false) {
            abort(503);
        }
        view()->share([
            'modal_type' => $modal_type,
            'popup' => $popup,
            'popup_check' => $popup_check,
            'loader' => $loader,
            'menus' => $menus,
            'config' => $config,
            'footer' => $footer,
            'marquee' => $marquee,
            'categories' => $categories,
            'currencies' => $currencies,
            'currency' => $currency,
        ]);
    }
}
