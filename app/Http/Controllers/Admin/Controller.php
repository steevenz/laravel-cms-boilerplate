<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class Controller extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $theme = Config::get('admin.theme');

        View::addLocation(base_path() . '/resources/themes/admin/' . $theme . '/layouts/');
        View::addLocation(base_path() . '/resources/themes/admin/' . $theme . '/views/');
    }
}
