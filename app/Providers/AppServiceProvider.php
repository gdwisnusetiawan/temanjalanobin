<?php

namespace App\Providers;

use App\Config;
use App\Footer;
use App\Subcategory;
use App\Marquee;
use App\Popup;
use App\Helpers\Functions;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

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
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        $modal_type = rand(0,7);
        $modal_type = 0;
        $popup = Popup::where('is_active', true)->first();
        $loader = 2;
        $menus = Functions::menu();
        $config = Config::where('is_active', true)->orderBy('id', 'desc')->first();
        $footer = Footer::where('is_active', true)->orderBy('id', 'desc')->first();
        $marquee = Marquee::first();
        $subcategories = Subcategory::with('categories')->get();
        $user_referer = \App\User::whereNotNull('referalid')->where('referalid', request()->get('referal'))->first();
        // dd($user_referer);
        view()->share([
            'modal_type' => $modal_type,
            'popup' => $popup,
            'loader' => $loader,
            'menus' => $menus,
            'config' => $config,
            'footer' => $footer,
            'marquee' => $marquee,
            'subcategories' => $subcategories,
        ]);
    }
}
