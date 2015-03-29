<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends CommonController {

	public function article($id)
    {
        $article = Article::findOrFail($id);

        if ($article->category_id == 0) {
            return redirect("page/{$article->category_id}");
        }

        return view('page.article')->withArticle($article);
    }

    public function category($id)
    {
        $category = Category::with('articles')->where('id', '=', $id)->firstOrFail();

        return view('page.category')->withCategory($category);
    }
}
