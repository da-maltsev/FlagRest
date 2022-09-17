<?php

namespace Tests\Unit;

use Tests\TestCase;

class FilmShowTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_show_film_correct()
    {
        $response = $this->get('/api/films/1');
        $response->assertStatus(200);
    }

    public function test_show_film_missing()
    {
        $response = $this->get('/api/films/9999');
        $response->assertStatus(404);
    }

    public function test_show_film_incorrect()
    {
        $response = $this->get('/api/films/artist');
        $response->assertStatus(404);
    }
}
