<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Providers\ThemeServiceProvider;

/**
 * Admin Routes
 */
Route::get('/themes/{filePath}', function($filePath){
    ThemeServiceProvider::serveAsset('themes/admin/' . $filePath);
})->where('filePath', '([A-z0-9\/_.]+)?');

Route::get('posts', [Admin\Posts::class, 'index']);
Route::post('create', [Admin\Posts::class, 'create']);
