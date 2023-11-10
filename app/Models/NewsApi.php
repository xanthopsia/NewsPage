<?php

namespace App\Models;

use App\Collections\ArticleCollection;
use GuzzleHttp\Client;

class NewsApi
{
    private const API_URL = 'https://newsapi.org/v2/';

    private Client $client;

    public function __construct()
    {
        $this->client = new Client(['verify' => false]);
    }


    public function getTopHeadlines(string $q, string $country, string $fromDate, string $toDate): ArticleCollection
    {
        $articles = new ArticleCollection();
        $response = $this->client->get(self::API_URL . "top-headlines?q=$q&country=$country&from=$fromDate&to=$toDate&apiKey=44a16dd76be74be5b76312dc8237b87c");
        $result = json_decode((string)($response->getBody()));
        foreach ($result->articles as $article) {
            $articles->add(new Article(
                $article->title,
                $article->description,
                $article->url,
                $article->urlToImage,
                $article->publishedAt
            ));
        }
        return $articles;
    }
}