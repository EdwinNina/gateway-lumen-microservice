<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    use ApiResponse;

    public $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Return authors list
     * @return Illuminate\Http\Response
    */
    public function index()
    {
        return $this->successResponse($this->authorService->getAuthors());
    }

    /**
     * Create an instance of author
     * @return Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        return $this->successResponse($this->authorService->createAuthor($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Return an specific author
     * @return Illuminate\Http\Response
    */
    public function show($author)
    {
        return $this->successResponse($this->authorService->getAuthor($author));
    }

    /**
     * Create the information of an existing author
     * @return Illuminate\Http\Response
    */
    public function update(Request $request, $author)
    {
        return $this->successResponse($this->authorService->editAuthor($request->all(), $author));
    }

    /**
     * Remove an existing author
     * @return Illuminate\Http\Response
    */
    public function destroy($author)
    {
        return $this->successResponse($this->authorService->deleteAuthor($author));
    }
}
