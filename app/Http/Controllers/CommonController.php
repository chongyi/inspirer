<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Category;

class CommonController extends Controller {

	public function __construct()
    {
        $categorys = Category::where('display_in_nav', '=', true)->get();

        $function = function($closure, $categorys, $pid = 0) {
            $return = null;

            foreach ($categorys as $category) {

                if ($category->parent_id == $pid) {
                    if (null != $children = call_user_func($closure, $closure, $categorys, $category->id) ) {
                        $return[] = [$category, $children];
                    } else {
                        $return[] = $category;
                    }
                }
            }

            return $return;
        };

        view()->share('categorys', $function($function, $categorys));
    }

}
