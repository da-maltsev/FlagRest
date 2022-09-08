<?php

namespace Tests\Unit;

use Tests\TestCase;

class FilmIndexTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_index_film_no_query()
    {
        $response = $this->get('/api/films');
        $response->assertStatus(200);
    }

    public function test_index_film_with_genre()
    {
        $response = $this->get('/api/films?filter[genre_id]=1');
        $response->assertStatus(200);
    }

    public function test_index_film_with_artist()
    {
        $response = $this->get('/api/films?filter[artist_id]=1');
        $response->assertStatus(200);
    }

    public function test_index_film_with_sort()
    {
        $response = $this->get('/api/films?sort=title');
        $response->assertStatus(200);
    }

    public function test_index_film_with_all_params()
    {
        $response = $this->get('/api/films?sort=-title&filter[genre_id]=1&filter[artist_id]=2');
        $response->assertStatus(200);
    }

    public function test_index_film_with_wrong_genre()
    {
        $response = $this->get('/api/films?filter[genre_id]=artist');
        $response->assertStatus(500);
    }

    public function test_index_film_with_wrong_artist()
    {
        $response = $this->get('/api/films?filter[artist_id]=qwerty');
        $response->assertStatus(500);
    }
}
