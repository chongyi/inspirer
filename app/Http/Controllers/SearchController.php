<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends CommonController
{

    public function search(Request $request, $searchKeywords)
    {
        $xs = new \XS('inspirer');

        $search = $xs->search;

        $page = $request->get('p', 1);
        $page = $page < 1 ? 1 : $page;

        $result = $search->setQuery($searchKeywords)->setLimit(6, ($page - 1) * 5)->search();

        if (count($result) == 0) {
            abort(404);
        }

        $next = count($result) < 6 ? null : $request->getPathInfo() . "?p=" . ($page + 1);
        $prev = $page == 1 ? null : $request->getPathInfo() . "?p=" . ($page - 1);

        $articles = [];

        foreach ($result as $key => $row) {
            $articles[] = (object)array(
                'id'            => $row->id,
                'name'          => $row->name,
                'title'         => $search->highlight($row->title),
                'originalTitle' => $row->title,
                'description'   => $search->highlight($row->description),
                'content'       => $search->highlight($row->content)
            );
        }

        return view('page/search',
            ['articles' => $articles, 'searchKeyword' => $searchKeywords, 'next' => $next, 'prev' => $prev]);
    }

}
