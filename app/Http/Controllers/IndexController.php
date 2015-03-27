<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\CommonController;
use Parsedown;
use Illuminate\Http\Request;
use App\Models\Article;


class IndexController extends CommonController {

	public function index(Request $request)
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(10);

        return view('home', ['articles' => $articles, 'parse' => new Parsedown]);
    }

}
