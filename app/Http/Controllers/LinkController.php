<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use PhpParser\Node\VarLikeIdentifier;

class LinkController extends Controller
{
    const FIFTEEN_MIN = 15 * 60;

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
            static::FIFTEEN_MIN,
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
