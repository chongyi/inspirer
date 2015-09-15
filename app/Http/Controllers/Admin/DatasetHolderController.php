<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Inspirer\Models\Article;
use Illuminate\Http\Request;

class DatasetHolderController extends Controller {

	public function getArticles()
    {
        return response()->json(['list' => DB::table('articles')->select('id', 'title')->get()]);
    }

}
