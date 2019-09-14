<?php

namespace Tests\Unit;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class BookTest extends TestCase
{
    use WithFaker;

    public function testCreateABook()
    {
        list($isbn, $obj) = $this->createBook();

        $this->assertEquals($isbn, $obj->isbn);
        $this->assertTrue(isset($obj->uuid));

        $this->assertDatabaseHas('statuses', [
            'book_id' => $obj->id,
            'status' => 'IN'
        ]);
    }

    public function testCreateABookAndDescription()
    {
        $isbn = $this->faker->isbn13;
        $attributes = [
            'isbn' => $isbn,
            'title' => $this->faker->sentence(),
        ];

        $obj = Book::createWithAttributes($attributes);

        $this->assertEquals($isbn, $obj->isbn);
        $this->assertTrue(isset($obj->uuid));

        $obj->addDescription(
            'This is the test description', 'en'
        );

        $obj->addAuthor($this->faker->name);

        $this->assertDatabaseHas('book_descriptions', [
            'book_id' => $obj->id,
            'description' => 'This is the test description',
            'language' => 'en',
        ]);

        $this->assertDatabaseHas('statuses', [
            'book_id' => $obj->id,
            'status' => 'IN'
        ]);

        $this->assertTrue($obj->descriptions->count() == 1, 'Has one description');

        $this->assertTrue($obj->authors->count() == 1, 'Has one Author');
    }

    public function testCheckout()
    {
        list($isbn, $obj) = $this->createBook();

        $this->assertDatabaseHas('books', [
            'isbn' => $isbn,
        ]);

        Book::checkout($isbn);

        $this->assertDatabaseHas('statuses', [
            'book_id' => $obj->id,
            'status' => 'OUT'
        ]);
    }

    public function testCheckin()
    {
        list($isbn, $obj) = $this->createBook();

        Book::checkin($isbn);

        $this->assertDatabaseHas('statuses', [
            'book_id' => $obj->id,
            'status' => 'IN'
        ]);
    }

    /**
     * @return array
     */
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
}
