<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use Session;

class MainController extends BaseController {

	public function index()
	{
		return view('admin.main')->withActive('dashboard');
	}

	public function login()
	{
		return view('admin.login', ['active' => 'login']);
	}

	public function logout()
	{
		Auth::logout();

		return redirect()->back();
	}

	public function loginProgress(Request $request)
	{
		$check = Validator::make($request->all(), [
			'username' => ['required'],
			'password' => ['required'],
			'remember' => ['boolean']
			]);

		if ($check->fails()) {
			return redirect()->back()->withErrors($check->errors());
		}

		if (Auth::attempt($request->only('username', 'password'), $request->input('remember', true))) {
			return redirect()->intended('admin');
		} else {
			return redirect()->back()->withErrors(['username' => 'These credentials do not match our records.']);
		}
	}

}
