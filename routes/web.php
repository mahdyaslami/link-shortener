<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'links/create');

Route::get('links/create', [LinkController::class, 'create'])
    ->name('links.create');
Route::post('links', [LinkController::class, 'store']);
Route::get('links/{slug}', [LinkController::class, 'show'])
    ->name('links.show');

Route::get('goto/{slug}', [LinkController::class, 'redirect'])
    ->name('redirect');