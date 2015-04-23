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

        return view('page.category')->withCategory($category)->withArticles($category->articles()->paginate(10));
    }

    public function tag($id)
    {
        $tag = Tag::with(array('articles' => function($query) {
            $query->orderBy('sort', 'desc')
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'desc');
        }))->where('id', '=', $id)->firstOrFail();

        return view('page.tag')->withTag($tag)->withArticles($tag->articles()->paginate(10));
    }

    public function target($name)
    {
        if ($article = Article::where('name', '=', $name)->first()) {
            if ($article->category_id == 0) {
                return view('page.page')->withArticle($article);
            }
            return view('page.article')->withArticle($article);
        } elseif ($category = Category::where('name', '=', $name)->first()) {
            return view('page.category')->withCategory($category)->withArticles($category->articles()->paginate(10));
        }

        abort(404);
    }
}
