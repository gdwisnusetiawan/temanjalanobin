<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.index');
    }

    public function single(Request $request)
    {
        // default, slider, video, audio
        $type = $request->type ?? $request->keys()[0] ?? 'default';
        return view('news.single', compact('type'));
    }
}
