<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Inspirer\Models\Tag;
use Validator;
use Illuminate\Http\Request;

class TagController extends Controller {

	public function __construct()
	{
		view()->share('active', 'tag');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			return response(Tag::all());
		}

		$tags = Tag::with('articles')
			->orderBy('created_at', 'desc')
			->paginate(8);

		return view('admin.tag.index', ['tags' => $tags]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.tag.edit');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$check = Validator::make($request->all(), [
			'display_name' => ['required', 'min:1', 'max: 255'],
			'name' => ['required', 'enstring'],
			]);

		if ($check->fails()) {
			return redirect()->back()->withErrors($check->errors())->withInput();;
		}

		Tag::create($request->only('name', 'display_name', 'description'));

		return redirect('admin/tag');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tag = Tag::findOrFail($id);

		return view('admin.tag.edit', ['tag' => $tag]);
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
			'display_name' => ['required', 'min:1', 'max: 255'],
			'name' => ['required', 'enstring'],
			]);

		if ($check->fails()) {
			return redirect()->back()->withErrors($check->errors())->withInput();;
		}

		$tag = Tag::findOrFail($id);

		$tag->display_name = $request->input('display_name');
		$tag->name = $request->input('name');
		$tag->description = $request->input('description', '');

		$tag->save();

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
		Tag::findOrFail($id)->delete();

		return redirect('admin/tag');
	}

}
