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

        $response = $this->actingAs($user)->json('POST', '/api/book', [
            'isbn' => $this->faker->isbn13,
            'title' => $this->faker->sentence(),
        ]);
        
        
        $response->assertStatus(200)->dump()
        
            ->assertJsonStructure([
                'title',
                'isbn',
                'uuid',
            ]);
    }
}
