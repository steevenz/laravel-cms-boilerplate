<?php


namespace App\Http\Controllers\Site;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

/**
 * Class Controller
 * @package App\Http\Controllers\Site
 */
class Controller extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $theme = Config::get('site.theme');

        View::addLocation(base_path() . '/resources/themes/site/' . $theme . '/layouts/');
        View::addLocation(base_path() . '/resources/themes/site/' . $theme . '/views/');
    }
}
