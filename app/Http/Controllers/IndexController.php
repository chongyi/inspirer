<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\CommonController;
use Parsedown;
use Illuminate\Http\Request;
use App\Inspirer\Models\Article;


class IndexController extends CommonController {

	public function index(Request $request)
    {
        $articles = Article::where('category_id', '!=', 0)
            ->orderBy('sort', 'desc')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('home', ['articles' => $articles, 'parse' => new Parsedown]);
    }

}
