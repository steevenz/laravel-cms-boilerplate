<?php
namespace App\Http\Controllers\Site;

use App\Models\Posts;

/**
 * Class Frontpage
 * @package App\Http\Controllers
 */
class Frontpage extends Controller
{
    /**
     * Frontpage::index
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('frontpage', [
            'posts' => Posts::paginate(5)
        ]);
    }
}
