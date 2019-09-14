<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class CreateABookTest extends TestCase
{
    use WithFaker;
    
    public function testCreateBasicBook()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('/api/books', [
            'isbn' => $this->faker->isbn13,
            'title' => $this->faker->sentence(),
        ]);
        
        
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'isbn',
                    'descriptions' => [
                        'data'
                    ]
                ]
            ]);
    }

    public function testCreateBookWithDescriptionsAndAuthors()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('/api/books', [
            'isbn' => $this->faker->isbn13,
            'title' => $this->faker->sentence(),
            'descriptions' => [
                [
                    'description' => 'This is a book description',
                    'language' => 'en'
                ],
                [
                    'description' => 'Esta es una descripción del libro.',
                    'language' => 'es'
                ]
            ]
        ]);
        
        
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'isbn',
                    'descriptions' => [
                        'data' => [
                            0,
                            1,
                        ]
                    ]
                ]
            ]);
    }
}
