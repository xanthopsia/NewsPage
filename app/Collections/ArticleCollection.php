<?php

namespace App\Collections;

use App\Models\Article;

class ArticleCollection
{
    private array $articles;

    public function __construct()
    {
        $this->articles = [];
    }

    public function add(Article $article): void
    {
        $this->articles[] = $article;
    }

    public function get(): array
    {
        return $this->articles;
    }
}