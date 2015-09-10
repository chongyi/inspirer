<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Inspirer\Models\Article;
use App\Inspirer\Models\Category;
use App\Inspirer\Models\Tag;
use Illuminate\Http\Request;

class PageController extends CommonController
{

    public function article($name)
    {
        if (is_numeric($name)) {
            $article = Article::where('display', '=', true)->where('id', '=', $name)->firstOrFail();
        } else {
            $article = Article::where('display', '=', true)->where('name', '=', $name)->firstOrFail();
        }

        $article->increment('views');

        if ($article->category_id == 0) {
            return view('page.page')->withArticle($article);
        }

        return view('page.article')->withArticle($article);
    }

    public function category($name)
    {
        if (is_numeric($name)) {
            $category = Category::with('articles')->where('id', '=', $name)->firstOrFail();
        } else {
            $category = Category::with('articles')->where('name', '=', $name)->firstOrFail();
        }

        return view('page.category')
            ->with('category', $category)
            ->with(
                'articles',
                $category->articles()->where('display', '=', true)->orderBy('sort', 'desc')
                         ->orderBy('created_at', 'desc')
                         ->orderBy('id', 'desc')
                         ->paginate(10)
            );
    }

    public function tag($name)
    {
        if (is_numeric($name)) {
            $tag = Tag::with('articles')->where('id', '=', $name)->firstOrFail();
        } else {
            $tag = Tag::with('articles')->where('name', '=', $name)->firstOrFail();
        }

        return view('page.tag')->with('tag', $tag)
                               ->with('articles', $tag->articles()
                                                      ->where('display', '=', true)
                                                      ->orderBy('created_at', 'desc')
                                                      ->paginate(10));
    }

    public function page($name)
    {
        if (is_numeric($name)) {
            $page = Article::where('display', '=', true)->where('category_id', '=', 0)->firstOrFail($name);
        } else {
            $page = Article::where('display', '=', true)
                           ->where('category_id', '=', 0)
                           ->where('name', '=', $name)
                           ->firstOrFail();
        }

        $page->increment('views');

        return view('page.page')->with('article', $page);
    }

    public function archive($year, $month)
    {
        $articles = Article::where(\DB::raw("DATE_FORMAT(`created_at`, '%Y %c')"), '=', "$year $month")
                           ->where('category_id', '!=', 0)
                           ->where('display', '=', true)
                           ->orderBy('created_at', 'desc')
                           ->paginate(5);

        return view('page.archive')->with('articles', $articles);
    }
}
