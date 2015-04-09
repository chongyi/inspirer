<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Nav;

class CommonController extends Controller {

	public function __construct()
    {
        $navs = Nav::all();

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
        view()->share('options', $options);
    }

}
