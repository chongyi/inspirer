<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TestController extends Controller {

	public function getFuck($id ,$msg)
    {
        var_dump($id);
        var_dump($msg);
    }
}
