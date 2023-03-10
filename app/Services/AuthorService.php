<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;

class AuthorService
{
    use ConsumeExternalService;

    /**
     * The base uri to be used to consume the authors service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to be used to consume the authors service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
        $this->secret = config('services.authors.secret');
    }

    public function getAuthors()
    {
        return $this->performRequest('GET', '/authors');
    }

    public function createAuthor($data)
    {
        return $this->performRequest('POST', '/authors', $data);
    }

    public function getAuthor($author)
    {
        return $this->performRequest('GET', "/authors/{$author}");
    }

    public function editAuthor($data, $author)
    {
        return $this->performRequest('PUT', "/authors/{$author}", $data);
    }

    public function deleteAuthor($author)
    {
        return $this->performRequest('DELETE', "/authors/{$author}");
    }
}
