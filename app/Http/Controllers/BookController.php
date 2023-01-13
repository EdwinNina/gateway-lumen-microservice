<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Services\BookService;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ApiResponse;

    public $bookService;
    public $authorService;

    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    /**
     * Return books list
     * @return Illuminate\Http\Response
    */
    public function index()
    {
        return $this->successResponse($this->bookService->getBooks());
    }

    /**
     * Create an instance of book
     * @return Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $this->authorService->getAuthor($request->author_id);

        return $this->successResponse($this->bookService->createBook($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Return an specific book
     * @return Illuminate\Http\Response
    */
    public function show($book)
    {
        return $this->successResponse($this->bookService->getBook($book));
    }

    /**
     * Create the information of an existing book
     * @return Illuminate\Http\Response
    */
    public function update(Request $request, $book)
    {
        return $this->successResponse($this->bookService->editBook($request->all(), $book));
    }

    /**
     * Remove an existing book
     * @return Illuminate\Http\Response
    */
    public function destroy($book)
    {
        return $this->successResponse($this->bookService->deleteBook($book));
    }
}
