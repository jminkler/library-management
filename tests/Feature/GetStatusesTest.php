<?php

namespace Tests\Feature;

use Tests\TestCase;

class GetStatusesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/api/statuses');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [

                ]
            ]);
    }
}
