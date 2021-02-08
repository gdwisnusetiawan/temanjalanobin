<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Page;
use App\Multipage;
use App\Multisubpage;
use App\DistributorLocation;
use App\Product;
use App\Helpers\Functions;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class PageController extends Controller
{
    public function index($slug)
    {
        // $menu = Menu::whereHas('page', function (Builder $query) use ($slug) {
        //     $query->where('slug', $slug);
        // })->orWhereHas('multipage', function (Builder $query) use ($slug) {
        //     $query->where('slug', $slug);
        // })->first();
        
        if(Str::contains($slug, ['new', 'arrival'])) {
            $products = Product::where('special', true)->get();
            return view('new-arrival', compact('products'));
        }

        if(Str::contains($slug, 'distributor')) {
            $locations = DistributorLocation::with('distributors')->get();
            return view('pages.distributor', compact('locations'));
        }
        if(Str::contains($slug, ['contact', 'kontak'])) {
            return view('pages.contact');
        }
        if(Str::contains($slug, 'faq')) {
            return view('pages.faq');
        }
        $page = Page::where('slug', $slug)->where('is_active', true)->first() 
            ?? Multipage::with('submultipages')->where('slug', $slug)->where('is_active', true)->first();
        if(isset($page))
        {
            if($page->page_type == 'single') {
                // $view = 'pages.single';
                return view('pages.single', compact('page'));
            }
            elseif($page->page_type == 'multiple') {
                // $view = 'pages.multiple';
                $multisubpages = Multisubpage::where('multipagesid', $page->id)->paginate(6);
                return view('pages.multiple', compact('page', 'multisubpages'));
            }
        }
        else
        {
            abort(404);
        }
        // return view($view, compact('page'));
    }

    public function show($parent, $slug)
    {
        $page = Multisubpage::where('slug', $slug)->where('is_active', true)->first();
        $prev_page = Multisubpage::where('id', '<', $page->id)->orderBy('id', 'desc')->first();
        $next_page = Multisubpage::where('id', '>', $page->id)->orderBy('id')->first();
        $recents = Multipage::with('submultipages')->where('slug', $parent)->first()->submultipages->where('is_active', true)->sortBy('datetime')->take(3);
        $populars = [];
        $share_links = Functions::shareLink(url()->full());
        // dd($recents);
        if(isset($page))
        {
            return view('pages.submultiple', compact('page', 'prev_page', 'next_page', 'recents', 'populars', 'share_links'));
        }
        else
        {
            abort(404);
        }
    }
}
