<?php

namespace Tests\Unit;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testCreateABook()
    {
        $attributes = [
            'isbn' => $this->faker->isbn13
        ];

        $obj = Book::createWithAttributes($attributes);
    }
}
