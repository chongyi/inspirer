<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\CommonController;
use App\Inspirer\Models\ArticleRecommend;
use Parsedown;
use Illuminate\Http\Request;
use App\Inspirer\Models\Article;


class IndexController extends CommonController
{

    public function index(Request $request)
    {
        $articles = Article::where('category_id', '!=', 0)
                           ->where('display', '=', true)
                           ->orderBy('created_at', 'desc')
                           ->orderBy('id', 'desc')
                           ->paginate(10);

        $recommendDataset =
            ArticleRecommend::count() >= 6 ? ArticleRecommend::orderBy('sort', 'DESC')->skip(0)->take(6)->get() : [];

        $firstRecommend = null;
        $recommends     = null;

        foreach ($recommendDataset as $recommend) {
            if (is_null($firstRecommend)) {
                $firstRecommend = $recommend->article;
            } else {
                $recommends[] = $recommend->article;
            }
        }

        return view('home', [
            'articles'       => $articles,
            'parse'          => new Parsedown,
            'recommends'     => $recommends,
            'firstRecommend' => $firstRecommend
        ]);
    }

}
