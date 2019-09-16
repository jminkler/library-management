<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckBookRequest;
use App\Http\Requests\CreateBookRequest;
use App\Transformers\BookTransformer;
use EllipseSynergie\ApiResponse\Contracts\Response;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $page = $request->page ?: 1;
        $offset = $perPage * $page;

        $statuses = Book::latest()
            ->offset($offset)
            ->paginate($perPage);

        return $this->response->withPaginator(
            $statuses,
            new BookTransformer
        );
    }

    public function store(CreateBookRequest $request)
    {
        $book = Book::createWithAttributes($request->all());

        return $this->response->withItem($book, new BookTransformer);
    }

    public function show(Book $book)
    {
        return $this->response->withItem($book, new BookTransformer);
    }

    public function update(Book $book, Request $request)
    {
        $book = Book::updateWithAttributes($book->uuid, $request->all());

        return $this->response->withItem($book, new BookTransformer);
    }

    public function updateAuthors(Book $book, Request $request)
    {
        $book = Book::updateAuthors($book->uuid, $request->all());

        return $this->response->withItem($book, new BookTransformer);
    }

    public function updateDescriptions(Book $book, Request $request)
    {
        $book = Book::updateDescriptions($book->uuid, $request->all());

        return $this->response->withItem($book, new BookTransformer);
    }


    public function destroy(Book $book)
    {
        $book->remove();

        return $this->response->withItem($book, new BookTransformer);
    }

    public function checkout(CheckBookRequest $request)
    {
        $book = Book::checkout($request->isbn);

        return $this->response->withItem($book, new BookTransformer);
    }

    public function checkin(CheckBookRequest $request)
    {
        $book = Book::checkin($request->isbn);

        return $this->response->withItem($book, new BookTransformer);
    }
}
