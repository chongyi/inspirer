<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Inspirer\Models\Article;
use App\Inspirer\Models\ArticleRecommend;
use Illuminate\Http\Request;

/**
 * Class RecommendController
 *
 * 负责管理首页推荐、通告信息
 *
 * @package App\Http\Controllers\Admin
 */
class RecommendController extends Controller
{
    public function __construct()
    {
        view()->share('active', 'recommend');
    }

    public function getIndex()
    {
        $articles = ArticleRecommend::all();

        return view('admin.recommend.edit')
            ->with('articles', $articles)
            ->with('articleList', \DB::table('articles')
                                     ->select('id', 'title')
                                     ->where('category_id', '!=', 0)
                                     ->orderBy('created_at', 'DESC')
                                     ->get());
    }

    public function postArticle(Request $request)
    {
        $validate = \Validator::make($request->only('article_id', 'sort'), [
            'article_id' => 'required|numeric',
            'sort' => 'required|numeric'
        ]);

        if ($validate->fails()) {
            abort(503);
        }

        $article = Article::findOrFail($request->input('article_id'));

        $recommend = new ArticleRecommend();
        $recommend->article_id = $article->id;
        $recommend->sort = $request->input('sort');

        $recommend->save();

        return redirect()->route('admin.recommend.index');
    }

    public function deleteArticle(Request $request)
    {
        if ($request->has('id')) {
            $recommend = ArticleRecommend::findOrFail($request->input('id'));
            $recommend->delete();

            return response()->json(['status' => 1]);
        }

        abort(404);
    }

}
