<?php

namespace App\Console;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Env
{
    public static function keyExists($key)
    {
        $content = static::get();

        return Str::contains($content, $key);
    }

    public static function updateAppKey()
    {
        Artisan::call('key:generate', [ '--show' => true]);

        $key = trim(Artisan::output());

        static::update('APP_KEY', $key);
    }

    public static function update($key, $value)
    {
        $content = static::get();

        $content = preg_replace("/({$key}=).*/", "$1\"{$value}\"", $content);

        static::save($content);
    }

    private static function get()
    {
        return File::get(
            static::path()
        );
    }

    private static function save($content)
    {
        return File::replace(
            static::path(),
            $content
        );
    }

    public static function exists()
    {
        return File::exists(
            static::path()
        );
    }

    public static function existsExample()
    {
        return File::exists(
            static::pathToExample()
        );
    }

    public static function replaceExample()
    {
        return File::copy(
            static::pathToExample(),
            static::path()
        );
    }

    public static function path()
    {
        return base_path('.env');
    }

    public static function pathToExample()
    {
        return base_path('.env.example');
    }
}
