<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class GuardianController extends Controller
{
    
    public function getArticles(Request $request)
    {    
        $params = array(
            "q" => $request->input('q'),
            "format" => $request->input('format'),
            "section" => $request->input('section'),
            "reference" => $request->input('reference'),
            "reference-type" => $request->input('reference-type'),
            "tag" => $request->input('tag'),
            "lang" => $request->input('lang'),
            "from-date" => $request->input('from-date'),
            "to-date" => $request->input('to-date'),
            "use-date" => $request->input('use-date'),
            "page" => $request->input('page'),
            "page-size" => $request->input('page-size'),
            "order-by" => $request->input('order-by'),
            "show-tags" => $request->input('show-tags'),
            "api_key" => $request->input('api_key'),
            "show-section" => $request->input('show-section'),
        );

        $query = '';

        foreach($params as $key => $val) {
            if ($val) {
                $query = $query. '&' .$key. '=' .$val;
            }
        }

        $articles = (new Helper)->makeGuardianAPiCall($query);

        return response()->json($articles);
    }
}
