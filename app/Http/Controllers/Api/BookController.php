<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Http\Requests\CreateBookRequest;
use App\Http\Controllers\Controller;
use App\Transformers\BookTransformer;

use EllipseSynergie\ApiResponse\Contracts\Response;

class BookController extends Controller
{
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function store(CreateBookRequest $request)
    {
        $book = Book::createWithAttributes($request->all());
        
        return $this->response->withItem($book, new BookTransformer);
    }
}
