<?php

namespace Tests\Unit;

use Tests\TestCase;

class FilmStoreTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_store_film_correct()
    {
        $response = $this->post('/api/films', ['title' => 'test title', 'genre_id' => 1]);
        $response->assertStatus(201);
    }

    public function test_store_film_incorrect_title()
    {
        $response = $this->post('/api/films', ['title' => 't', 'genre_id' => 1]);
        $response->assertStatus(422);
    }

    public function test_store_film_incorrect_genre_id()
    {
        $response = $this->post('/api/films', ['title' => 'title test', 'genre_id' => 'test']);
        $response->assertStatus(422);
    }

    public function test_store_film_missing_title()
    {
        $response = $this->post('/api/films', ['genre_id' => 1]);
        $response->assertStatus(422);
    }

    public function test_store_film_missing_genre_id()
    {
        $response = $this->post('/api/films', ['title' => 'title test']);
        $response->assertStatus(422);
    }
}
