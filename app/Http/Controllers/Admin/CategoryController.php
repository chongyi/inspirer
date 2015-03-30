<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Validator;
use DB;

class CategoryController extends Controller {

	public function __construct()
	{
		view()->share('active', 'category');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = Category::all();

		return view('admin.category.index', ['categories' => $categories]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.category.edit');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$check = Validator::make($request->all(), [
			'name' => ['required', 'enstring'],
			'display_name' => ['required'],
			]);

		if ($check->fails()) {
			return redirect()->back()->withErrors($check->errors())->withInput();
		}

		Category::create($request->only('name', 'display_name', 'description', 'parent_id'));

		return redirect('admin/category');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Request $request)
	{
		$category = Category::findOrFail($id);

		return view('admin.category.edit', ['category' => $category]);
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
			'name' => ['required', 'enstring'],
			'display_name' => ['required'],
			]);

		if ($check->fails()) {
			return redirect()->back()->withErrors($check->errors())->withInput();
		}

		$category = Category::findOrFail($id);

		foreach ($request->only('name', 'display_name', 'parent_id', 'description') as $key => $value) {
			$category->{$key} = $value;
		}

		$category->save();

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
		// traverse and delete
		DB::transaction(function() use ($id) {
			$self = Category::findOrFail($id);
			$this->traverseToDelete($self->id);
			$self->delete();
		});

		return redirect()->back();
	}

	protected function traverseToDelete($parent)
	{
		$t = Category::where('parent_id', '=', $parent)->get();
		foreach ($t as $category) {
			$this->traverseToDelete($category->id);
			$category->delete();
		}
	}

}
