<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Page;
use App\Multipage;
use App\Multisubpage;
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
        if(isset($page))
        {
            return view('pages.submultiple', compact('page', 'prev_page', 'next_page'));
        }
        else
        {
            abort(404);
        }
    }
}
