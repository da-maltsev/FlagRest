<?php

namespace App\Http\Controllers;

use App\Http\Queries\FilmIndexQuery;
use App\Http\Resources\FilmResource;
use App\Models\Film;
use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FilmController extends Controller
{
    /**
     * List of Films.
     *
     * @queryParam filter[genre_id], integer
     * @queryParam filter[artist_id], integer
     * @queryParam sort = title or -title for DESC order
     *
     */
    public function index(FilmIndexQuery $filmIndexQuery)
    {
        return FilmResource::collection($filmIndexQuery->get());
    }

    /**
     * @param StoreFilmRequest $request
     * @return Film
     */
    public function store(StoreFilmRequest $request): Film
    {
        return Film::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Film $film
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film): FilmResource
    {
        return new FilmResource($film);
    }

    /**
     * @param UpdateFilmRequest $request
     * @param Film $film
     * @return Film
     */
    public function update(UpdateFilmRequest $request, Film $film): Film
    {
        $film->update($request->validated());
        $film->save();
        return $film;
    }

    /**
     * @param Film $film
     * @return Response
     */
    public function destroy(Film $film)
    {
        $film->deleteOrFail();
        return response('', 204);
    }
}
