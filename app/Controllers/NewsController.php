<?php

namespace App\Controllers;

use App\Models\NewsApi;
use App\Response;

class NewsController
{

    private NewsApi $api;

    public function __construct()
    {
        $this->api = new NewsApi();
    }

    public function index(): Response
    {
        $queryParameters = $_GET;
        $country = $queryParameters['country'] ?: 'us';
        $query = $queryParameters['search'] ?: '';
        $fromDate = $queryParameters['fromDate'] ?: '';
        $toDate = $queryParameters['toDate'] ?: '';
        $data = $this->api->getTopHeadlines($query, $country, $fromDate, $toDate)->get();
        return new Response('News/index', ['articles' => $data]);
    }
}