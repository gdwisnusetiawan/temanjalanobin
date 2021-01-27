<?php

namespace App\Providers;

use App\Config;
use App\Footer;
use App\Subcategory;
use App\Helpers\Functions;
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
        $modal_type = rand(0,7);
        $modal_type = 0;
        $loader = 2;
        $menus = Functions::menu();
        $config = Config::where('is_active', true)->orderBy('id', 'desc')->first();
        $footer = Footer::where('is_active', true)->orderBy('id', 'desc')->first();
        $subcategories = Subcategory::with('categories')->get();
        // dd($subcategories);
        view()->share([
            'modal_type' => $modal_type,
            'loader' => $loader,
            'menus' => $menus,
            'config' => $config,
            'footer' => $footer,
            'subcategories' => $subcategories
        ]);
    }
}
