<?php

namespace App\Models;

use DateTime;

class Article
{
    private ?string $title;
    private ?string $description;
    private ?string $url;
    private ?string $imageUrl;
    private ?string $publicationDate;

    public function __construct(?string $title,
                                ?string $description,
                                ?string $url,
                                ?string $imageUrl,
                                ?string $publicationDate)
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->imageUrl = $imageUrl;
        $this->publicationDate = (new DateTime($publicationDate))->format('Y-m-d');

    }


    public function getTitle(): string
    {
        return $this->title;
    }


    public function getDescription(): string
    {
        return $this->description ?: " ";
    }


    public function getUrl(): string
    {
        return $this->url;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl ?: "https://www.tripwire.com/sites/default/files/blackcat.jpg";
    }

    public function getPublicationDate(): string
    {
        return $this->publicationDate;
    }


}