<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use jcobhams\NewsApi\NewsApi;
use Illuminate\Http\Request;

class NewsApiController extends Controller
{

    private $newsapi;

    public function __construct()
    {
        $this->newsapi = new NewsApi(config('app.news_api_key'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEverything(Request $request)
    {    
        $q = $request->input('q');
        $sources = $request->input('sources');
        $domains = $request->input('domains');
        $exclude_domains = $request->input('exclude_domains');
        $from = $request->input('from');
        $to = $request->input('to');
        $language = $request->input('language');
        $sort_by = $request->input('sort_by');
        $page_size = $request->input('page_size');
        $page = $request->input('page');

        # /v2/everything
        $all_articles = $this->newsapi->getEverything($q, $sources, $domains, $exclude_domains, $from, $to, $language, $sort_by,  $page_size, $page);

        return response()->json($all_articles);
    }

    /**
     * @param $request
     * @return mixed
     */
    protected function getTopHeadlines(Request $request)
    {
        $q = $request->input('q');
        $sources = $request->input('sources');
        $country = $request->input('country');
        $category = $request->input('category');
        $page_size = $request->input('page_size');
        $page = $request->input('page');


        # /v2/top-headlines
        $top_headlines = $this->newsapi->getTopHeadlines($q, $sources, $country, $category, $page_size, $page);

        return response()->json($top_headlines);
    }

    /**
     * @return mixed
     */
    public function fetchAllNewsSources(Request $request)
    {
        $category = $request->input('category');
        $language = $request->input('language');
        $country = $request->input('country');


        # /v2/top-headlines/sources
        $sources = $this->newsapi->getSources($category, $language, $country);

        return response()->json($sources);
    }
}