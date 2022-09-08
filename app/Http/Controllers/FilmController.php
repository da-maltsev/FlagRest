<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilmResource;
use App\Models\Film;
use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;
use Illuminate\Database\Eloquent\Concerns\QueriesRelationships;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
        {
            $films = QueryBuilder::for(Film::class)
                ->allowedFilters([AllowedFilter::exact('genre_id'),
                    AllowedFilter::exact('artists.id')])
                ->defaultSort('title')
                ->allowedSorts('title');

            return FilmResource::collection($films->get());
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFilmRequest $request
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
     * @param  \App\Models\Film $film
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        $film = new FilmResource(Film::findOrFail($film->id));
        return $film;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFilmRequest $request
     * @param  \App\Models\Film $film
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
     * @param  \App\Models\Film $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        $film = Film::findOrFail($film->id);
        $film->delete();
        return response(null, 204);
    }
}
