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
use App\Http\Controllers;
use App\Providers\ThemeServiceProvider;

/**
 * Site Routes
 */
Route::get('/themes/{path}', function($path){
    ThemeServiceProvider::serveAsset('themes/site/' . $path);
})->where('path', '([A-z0-9\/_.]+)?');
Route::get('/', [Controllers\Site\Frontpage::class, 'index']);

/**
 * Admin Routes
 */
Route::prefix('admin')->group(function(){
    Route::get('/themes/{path}', function($path){
        ThemeServiceProvider::serveAsset('themes/admin/' . $path);
    })->where('path', '([A-z0-9\/_.]+)?');

    Route::get('posts', [Controllers\Admin\Posts::class, 'index']);
    Route::post('create', [Controllers\Admin\Posts::class, 'create']);
});
