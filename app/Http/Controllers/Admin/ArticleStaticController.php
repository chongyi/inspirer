<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Inspirer\Models\Article;
use App\Inspirer\Models\Nav;
use App\Inspirer\Models\Option;
use App\Inspirer\Models\Tag;
use App\Inspirer\Models\Category;
use Illuminate\Http\Request;

class ArticleStaticController extends Controller {

    public function __construct()
    {
        view()->share('active', 'article');
    }

	public function create()
    {
        return view('admin/article/static');
    }

    public function store()
    {
        $articles = Article::all();

        if (!is_dir('html')) {
            mkdir('html');
        }

        $navs = Nav::orderBy('sort', 'desc')->get();

        $function = function($closure, $navs, $pid = 0) {
            $return = null;

            foreach ($navs as $nav) {

                if ($nav->parent_id == $pid) {
                    if (null != $children = call_user_func($closure, $closure, $navs, $nav->id) ) {
                        $return[] = [$nav, $children];
                    } else {
                        $return[] = $nav;
                    }
                }
            }

            return $return;
        };

        $d = Option::all();

        $options = [];

        foreach ($d as $option) {
            $options[$option->key] = $option->value;
        }

        view()->share('navs', $function($function, $navs));
        view()->share('categories', Category::all());
        view()->share('tags', Tag::all());
        view()->share('options', $options);
        view()->share('staticMode', true);
        view()->share('staticCreateTime', date('Y/m/d H:i:s', time()));

        foreach ($articles as $article) {
            if (empty($article->name)) {
                continue;
            }

            if ($article->category_id == 0) {

                $data = view('page.page')->withArticle($article)->render();
            } else {
                $data = view('page.article')->withArticle($article)->render();
            }


            file_put_contents('html/' . $article->name . '.html', $data);
        }

        return redirect('admin/article');
    }

}
