<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Inspirer\ArticleProcess;
use Illuminate\Http\Request;
use Validator;
use Parsedown;

class ArticleController extends Controller {

	

	public function __construct()
	{
		view()->share('active', 'article');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$articles = Article::with('category')
			->orderBy('sort', 'desc')
			->orderBy('created_at', 'desc')
			->paginate(8);

		return view('admin.article.index', ['articles' => $articles]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categorys = Category::getCategoryTree();

		return view('admin.article.edit', ['categorys' => $categorys]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$check = Validator::make($request->all(), [
			'title' => ['required', 'min:1', 'max: 255'],
			'category_id' => ['required', 'numeric']
			]);

		if ($check->fails()) {
			return redirect()->back()->withErrors($check->errors());
		}

		extract(ArticleProcess::convertArticle($request->input('content')));

		$insert = $request->only('title', 'category_id', 'keywords');
		$insert['content'] = $content;
		$insert['description'] = $request->has('description') 
			? $request->input('description') : strip_tags((new Parsedown)->text($description));

		Article::create($insert);

		return redirect('admin/article');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$article = Article::findOrFail($id);

		return view('admin.article.show', ['article' => $article]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Request $request)
	{
		$article = Article::findOrFail($id);

		$categorys = Category::getCategoryTree();

		return view('admin.article.edit', ['categorys' => $categorys, 'article' => $article]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$check = Validator::make($request->all(), [
			'title' => ['required', 'min:1', 'max: 255'],
			'category_id' => ['required', 'numeric']
			]);

		if ($check->fails()) {
			return redirect()->back()->withErrors($check->errors());
		}

		$article = Article::findOrFail($id);

		$insert = $request->only('title', 'category_id', 'keywords');
		$insert = array_merge($insert, ArticleProcess::convertArticle($request->input('content')));
		$insert['description'] = $request->has('description') 
			? $request->input('description') : strip_tags((new Parsedown)->text($insert['description']));
		extract($insert);

		$article->title = $title;
		$article->category_id = $category_id;
		$article->keywords = $keywords;
		$article->content = $content;
		$article->description = $description;
		$article->save();

		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Article::findOrFail($id)->delete();

		return redirect()->back();
	}

}
