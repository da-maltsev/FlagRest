<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $films = Film::query();
        $genre = $request->query('genre_id');
        $sort = $request->query('sort');
        if ($genre) {
            $films->where('genre_id', $genre);
        }
        if ($sort) {
            substr($sort,0,1) === '-' ? $films->orderBy('title', 'desc') : $films->orderBy('title');
        }

        return $films->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFilmRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFilmRequest $request)
    {
        $film = Film::create($request->validated());
        return $film;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        $film = Film::findOrFail($film->id);
        $artists = $film->artists()->pluck('name');
        return response()->json(['Film' => $film, 'Artists' => $artists]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFilmRequest  $request
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFilmRequest $request, Film $film)
    {
        $filmUpd = Film::findOrFail($film->id);
        $filmUpd->fill($request->all());
        $filmUpd->save();
        return $filmUpd;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        $film = Film::findOrFail($film->id);
        $film->delete();
        return response(null, 204);
    }
}
