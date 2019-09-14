<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Http\Requests\CreateBookRequest;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function store(CreateBookRequest $request)
    {
        $book = Book::createWithAttributes($request->all());
        
        return response()->json($book);
    }
}
