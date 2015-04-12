<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Inspirer\Models\Article;
use App\Inspirer\Models\Category;
use App\Inspirer\Models\Tag;
use Illuminate\Http\Request;

class PageController extends CommonController {

	public function article($id)
    {
        $article = Article::findOrFail($id);

        if ($article->category_id == 0) {
            return redirect("page/{$article->category_id}");
        }

        $article->increment('views');

        return view('page.article')->withArticle($article);
    }

    public function category($id)
    {
        $category = Category::with(array('articles' => function($query)
        {
            $query->orderBy('sort', 'desc')
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'desc');

        }))->where('id', '=', $id)->firstOrFail();

        return view('page.category')->withCategory($category);
    }

    public function tag($id)
    {
        $tag = Tag::with(array('articles' => function($query) {
            $query->orderBy('sort', 'desc')
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'desc');
        }))->where('id', '=', $id)->firstOrFail();

        return view('page.tag')->withTag($tag);
    }
}
