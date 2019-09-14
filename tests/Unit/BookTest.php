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
        $isbn = $this->faker->isbn13;
        $attributes = [
            'isbn' => $isbn,
            'title' => $this->faker->sentence(),
        ];

        $obj = Book::createWithAttributes($attributes);

        $this->assertEquals($isbn, $obj->isbn);
        $this->assertTrue(isset($obj->uuid));
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

        $this->assertTrue($obj->descriptions->count() == 1, 'Has one description');
        
        $this->assertTrue($obj->authors->count() == 1, 'Has one Author');
    }
}
