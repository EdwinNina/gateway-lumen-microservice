<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;

class BookService
{
    use ConsumeExternalService;

    /**
     * The base uri to be used to consume the Books service
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
        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    }

    public function getBooks()
    {
        return $this->performRequest('GET', 'books');
    }

    public function createBook($data)
    {
        return $this->performRequest('POST', 'books', $data);
    }

    public function getBook($book)
    {
        return $this->performRequest('GET', "books/{$book}");
    }

    public function editBook($data, $book)
    {
        return $this->performRequest('PUT', "books/{$book}", $data);
    }

    public function deleteBook($book)
    {
        return $this->performRequest('DELETE', "books/{$book}");
    }
}
