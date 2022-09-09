<?php

namespace App\Http\Queries;


use App\Models\Film;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FilmIndexQuery extends QueryBuilder
{
    public function __construct(Request $request = null)
    {
        $query = Film::query();
        parent::__construct($query, $request);

        $this->allowedFilters([AllowedFilter::exact('genre_id'),
                AllowedFilter::exact('artist_id', 'artists.id')])
            ->defaultSort('title')
            ->allowedSorts('title');
    }

}
