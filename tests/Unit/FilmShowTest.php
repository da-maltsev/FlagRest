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
    public function testShowFilmNoQuery()
    {
        $response = $this->get('/api/films');
        $response->assertStatus(200);
    }

    public function testShowFilmWithGenre()
    {
        $response = $this->get('/api/films?genre_id=1');
        $response->assertStatus(200);
    }

    public function testShowFilmWithArtist()
    {
        $response = $this->get('/api/films?artist_id=1');
        $response->assertStatus(200);
    }

    public function testShowFilmWithSort()
    {
        $response = $this->get('/api/films?sort=title');
        $response->assertStatus(200);
    }

    public function testShowFilmWithAllParams()
    {
        $response = $this->get('/api/films?sort=-title&genre_id=1&artist_id=2');
        $response->assertStatus(200);
    }
}
