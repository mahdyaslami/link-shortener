<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    use WithFaker;

    public function create()
    {
        return view('links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url'
        ]);

        $slug = $this->generateSlug();

        $this->remember($slug, $request->link);

        return redirect(
            route('links.show', $slug)
        );
    }

    private function generateSlug()
    {
        $this->setUpFaker();

        return Str::slug(
            $this->faker()->realText(20)
        );
    }

    private function remember($slug, $link)
    {
        Cache::remember(
            $slug,
            18000, // five hour
            fn () => $link
        );
    }

    public function show($slug)
    {
        if (Cache::has($slug)) {
            return view('links.show', [
                'url' => route('redirect', $slug)
            ]);
        }

        abort(404);
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
