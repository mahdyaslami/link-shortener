<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function create()
    {
        return view('links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url'
        ]);

        $key = Str::random(5);

        Cache::remember(
            $key,
            15 * 60,
            fn () => $request->link
        );
    }
}
