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

        $slug = Str::random(5);

        Cache::remember(
            $slug,
            15 * 60,
            fn () => $request->link
        );

        return url("goto/{$slug}");
    }

    public function redirect($slug)
    {
        if (Cache::has($slug)) {
            return redirect(
                Cache::get($slug),
                301
            );
        }

        abort(404);
    }
}
