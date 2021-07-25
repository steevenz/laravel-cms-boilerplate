<?php
use Illuminate\Support\Facades\Route;
use App\Providers\ThemeServiceProvider;
use App\Http\Controllers\Admin;

/**
 * Admin Routes
 */
Route::get('/themes/{filePath}', function($filePath){
    ThemeServiceProvider::serveAsset('themes/admin/' . $filePath);
})->where('filePath', '([A-z0-9\/_.]+)?');

Route::prefix('/posts')->group(function () {
    Route::get('/', [Admin\Posts::class, 'index']);
    Route::get('/create', [Admin\Posts::class, 'form']);
    Route::get('/update', [Admin\Posts::class, 'form']);
    Route::any('/store', [Admin\Posts::class, 'form']);
});
