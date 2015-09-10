<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Inspirer\Models\Article;
use App\Inspirer\Models\Category;
use App\Inspirer\Models\Tag;
use Illuminate\Http\Request;
use App\Inspirer\Models\Nav;
use App\Inspirer\Models\Option;
use DB;

class CommonController extends Controller
{

    public function __construct()
    {
        $navs = Nav::orderBy('sort', 'desc')->get();

        $function = function ($closure, $navs, $pid = 0) {
            $return = null;

            foreach ($navs as $nav) {

                if ($nav->parent_id == $pid) {
                    if (null != $children = call_user_func($closure, $closure, $navs, $nav->id)) {
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

        $collection = DB::table('articles')
                        ->select(DB::raw("DATE_FORMAT(`created_at`, '%Y %m') as `archive`, count(*) as `count`"))
                        ->where('category_id', '!=', 0)
                        ->where('display', '=', true)
                        ->orderBy('created_at', 'desc')
                        ->groupBy('archive')
                        ->get();



        view()->share('navs', $function($function, $navs));
        view()->share('categories', Category::all());
        view()->share('tags', Tag::all());
        view()->share('archive', $collection);
        view()->share('options', $options);
    }

}
