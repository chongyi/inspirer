<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Nav;
use Illuminate\Http\Request;
use Validator;

class NavController extends Controller {

	public function __construct()
	{
		view()->share('active', 'nav');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$navs = Nav::all();

		return view('admin.nav.index', ['navs' => $navs]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.nav.edit');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$check = Validator::make($request->all(), [
			'title' => ['required', 'min:1', 'max: 20'],
			'link' => ['required'],
			'sort' => ['numeric']
			]);

		if ($check->fails()) {
			return redirect()->back()->withErrors($check->errors());
		}

		Nav::create($request->only('title', 'link', 'sort'));

		return redirect('admin/nav');
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
		$nav = Nav::findOrFail($id);

		return view('admin.nav.edit', ['nav' => $nav]);
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
			'title' => ['required', 'min:1', 'max: 20'],
			'link' => ['required'],
			'sort' => ['numeric']
			]);

		if ($check->fails()) {
			return redirect()->back()->withErrors($check->errors());
		}

		$nav = Nav::findOrFail($id);

		$nav->title = $request->input('title');
		$nav->link = $request->input('link');
		$nav->sort = $request->input('sort');
		$nav->save();

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
		Nav::findOrFail($id)->delete();

		return redirect()->back();
	}

}
