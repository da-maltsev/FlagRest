<?php

namespace Tests\Unit;

use Tests\TestCase;

class FilmDeleteTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_delete_film_correct()
    {
        $response = $this->delete('/api/films/9');
        $response->assertStatus(204);
    }

    public function test_delete_film_correct_404_same_id()
    {
        $response = $this->delete('/api/films/9');
        $response->assertStatus(404);
    }

    public function test_delete_film_missing_id()
    {
        $response = $this->delete('/api/films/');
        $response->assertStatus(405);
    }
}
