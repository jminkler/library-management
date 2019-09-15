<?php

namespace Tests\Feature;

use App\Book;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckInOutBookTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCheckoutBook()
    {
        list($isbn, $obj) = $this->createBook();

        $response = $this->post('/api/books/checkout', [
            'isbn' => $isbn
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('books', [
            'id' => $obj->id,
            'status' => 'OUT'
        ]);
    }

    protected function createBook(): array
    {
        $isbn = $this->faker->isbn13;
        $attributes = [
            'isbn' => $isbn,
            'title' => $this->faker->sentence(),
        ];

        $obj = Book::createWithAttributes($attributes);
        return array($isbn, $obj);
    }

    public function testCheckinBook()
    {
        list($isbn, $obj) = $this->createBook();

        $response = $this->post('/api/books/checkin', [
            'isbn' => $isbn
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('books', [
            'id' => $obj->id,
            'status' => 'IN'
        ]);
    }
}
