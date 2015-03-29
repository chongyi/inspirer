<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Article;
use Illuminate\Http\Request;

class PageController extends CommonController {

	public function article($id)
    {
        $article = Article::findOrFail($id);

        return view('page.article')->withArticle($article);
    }

}
