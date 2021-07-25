<?php
use Illuminate\Support\Facades\Route;
use App\Providers\ThemeServiceProvider;
use App\Http\Controllers\Site;

/**
 * Site Routes
 */
Route::get('/themes/{filePath}', function($filePath){
    ThemeServiceProvider::serveAsset('themes/site/' . $filePath);
})->where('filePath', '([A-z0-9\/_.]+)?');

Route::get('/', [Site\Frontpage::class, 'index']);
