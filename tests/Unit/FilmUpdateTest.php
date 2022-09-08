<?php

namespace Tests\Unit;

use Tests\TestCase;

class FilmUpdateTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_update_film_correct()
    {
        $response = $this->patch('/api/films/1', ['title' => 'test title', 'genre_id' => 1]);
        $response->assertStatus(200);
    }

    public function test_update_film_incorrect_title()
    {
        $response = $this->patch('/api/films/2', ['title' => 't', 'genre_id' => 1]);
        $response->assertStatus(422);
    }

    public function test_update_film_incorrect_genre_id()
    {
        $response = $this->patch('/api/films/3', ['title' => 'title test', 'genre_id' => 'test']);
        $response->assertStatus(422);
    }

    public function test_update_film_missing_title()
    {
        $response = $this->patch('/api/films/1', ['genre_id' => 1]);
        $response->assertStatus(200);
    }

    public function test_update_film_missing_genre_id()
    {
        $response = $this->patch('/api/films/2', ['title' => 'title test']);
        $response->assertStatus(200);
    }

    public function test_update_film_with_post_method()
    {
        $response = $this->post('/api/films/2', ['title' => 'title test']);
        $response->assertStatus(405);
    }
}
