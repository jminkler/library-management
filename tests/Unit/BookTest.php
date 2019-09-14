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
        $isbn = $this->faker->isbn13;
        $attributes = [
            'isbn' => $isbn
        ];

        $obj = Book::createWithAttributes($attributes);

        $this->assertEquals($isbn, $obj->isbn);
        $this->assertTrue(isset($obj->uuid));
        
    }
}
