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
        
        $menu = Menu::where('title', 'like', '%'.$slug.'%')->first();
        if(Str::contains($slug, ['new', 'arrival', 'terlaris']) || (isset($menu) && $menu->id == 1)) {
            $products = Product::where('special', true)->get();
            $title = ucwords(str_replace('-', ' ', $slug));
            return view('new-arrival', compact('products', 'title'));
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
        $page = Page::whereSlug($slug)->where('is_active', true)->first() 
            ?? Multipage::with('submultipages')->whereSlug($slug)->where('is_active', true)->first();

        // dd($page);
        if(isset($page))
        {
            if($page->page_type == 'single') {
                // $view = 'pages.single';
                // $page->views = $page->views + 1;
                // $page->save();
                $share_links = Functions::shareLink(url()->full());
                return view('pages.single2', compact('page', 'share_links'));
            }
            elseif($page->page_type == 'multiple') {
                // $view = 'pages.multiple';
                $multisubpages = Multisubpage::where('is_active', true)->where('multipagesid', $page->id)->paginate(6);
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
        $page = Multisubpage::whereSlug($slug)->where('is_active', true)->first();
        $multipage = Multipage::with('submultipages')->whereSlug($parent)->first();
        $share_links = Functions::shareLink(url()->full());
        $prev_page = null;
        $next_page = null;
        $recents = [];
        $populars = [];
        // dd($recents);
        if(isset($multipage)) {
            $recents = $multipage->submultipages->where('is_active', true)->sortBy('datetime')->take(3);
            $populars = $multipage->submultipages->where('is_active', true)->sortByDesc('views')->take(3);
        }
        if(isset($page))
        {
            $prev_page = Multisubpage::where('id', '<', $page->id)->orderBy('id', 'desc')->first();
            $next_page = Multisubpage::where('id', '>', $page->id)->orderBy('id')->first();
            $page->views = $page->views + 1;
            $page->save();
            return view('pages.submultiple', compact('page', 'prev_page', 'next_page', 'recents', 'populars', 'share_links'));
        }
        else
        {
            abort(404);
        }
    }
}
