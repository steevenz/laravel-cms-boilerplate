<?php

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
use App\Http;

/**
 * Site Routes
 */
Route::any('/themes/{path}', function($path){
    Http\Theme::getFile(resource_path('themes/site/' . $path));
})->where('path', '([A-z0-9\/_.]+)?');
Route::get('/', [Http\Controllers\Site\Frontpage::class, 'index']);

/**
 * Admin Routes
 */
Route::prefix('admin')->group(function(){
    Route::any('/themes/{path}', function($path){
        Http\Theme::getFile(resource_path('themes/admin/' . $path));
    })->where('path', '([A-z0-9\/_.]+)?');

    Route::get('posts', [Http\Controllers\Admin\Posts::class, 'index']);
    Route::post('create', [Http\Controllers\Admin\Posts::class, 'create']);
});
