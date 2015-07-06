<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Inspirer\Models\Article;
use App\Inspirer\Models\Category;
use App\Inspirer\Models\Tag;
use Illuminate\Http\Request;

class PageController extends CommonController {

	public function article($id)
    {
        $article = Article::where('display', '=', true)->firstOrFail($id);

        if ($article->category_id == 0) {

            return redirect("page/{$article->category_id}");
        }

        $article->increment('views');

        return view('page.article')->withArticle($article);
    }

    public function category($id)
    {
        $category = Category::with('articles')->where('id', '=', $id)->firstOrFail();

        return view('page.category')
            ->withCategory($category)
            ->withArticles(
                $category->articles()->where('display', '=', true)->orderBy('sort', 'desc')
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'desc')
                ->paginate(10)
                );
    }

    public function tag($id)
    {
        $tag = Tag::with('articles')->where('id', '=', $id)->firstOrFail();

        return view('page.tag')->withTag($tag)
            ->withArticles($tag->articles()->where('display', '=', true)->paginate(10));
    }

    public function target($first, $second = null)
    {
        if (is_null($second)) {

            if ($article = Article::where('name', '=', $first)->where('display', '=', true)->first()) {

                if ($article->category_id == 0) {

                    return view('page.page')->withArticle($article);
                }

                return view('page.article')->withArticle($article);

            } elseif ($category = Category::with('articles')->where('name', '=', $first)->first()) {

                return view('page.category')
                    ->withCategory($category)
                    ->withArticles(
                        $category->articles()->where('display', '=', true)->orderBy('sort', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->orderBy('id', 'desc')
                        ->paginate(10)
                        );

            } elseif ($tag = Tag::where('name', '=', $first)->first()) {

                return view('page.tag')
                    ->withTag($tag)
                    ->withArticles(
                        $tag->articles()->where('display', '=', true)->orderBy('sort', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->orderBy('id', 'desc')
                        ->paginate(10)
                        );

            }
        } else {

            switch ($first) {
                case 'article':

                    $article = Article::where('name', '=', $second)->where('display', '=', true)->firstOrFail();

                    return view('page.article')->withArticle($article);

                    break;

                case 'category':
                case 'cat':
                case 'c':

                    $category = Category::with('articles')->where('name', '=', $second)->firstOrFail();

                    return view('page.category')
                        ->withCategory($category)
                        ->withArticles(
                            $category->articles()->where('display', '=', true)->orderBy('sort', 'desc')
                            ->orderBy('created_at', 'desc')
                            ->orderBy('id', 'desc')
                            ->paginate(10)
                            );

                    break;

                case 'tag':
                case 't':

                    $tag = Tag::with('articles')->where('name', '=', $second)->firstOrFail();

                    return view('page.tag')
                        ->withTag($tag)
                        ->withArticles(
                            $tag->articles()->where('display', '=', true)->orderBy('sort', 'desc')
                            ->orderBy('created_at', 'desc')
                            ->orderBy('id', 'desc')
                            ->paginate(10)
                            );
            }
        }

        abort(404);
    }
}
