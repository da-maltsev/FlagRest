<?php

namespace App\Http\Controllers;

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
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $films = QueryBuilder::for(Film::class)
            ->allowedFilters([AllowedFilter::exact('genre_id'),
                AllowedFilter::exact('artist_id', 'artists.id')])
            ->defaultSort('title')
            ->allowedSorts('title');

        return FilmResource::collection($films->get());
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
