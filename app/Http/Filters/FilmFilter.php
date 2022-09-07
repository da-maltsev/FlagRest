<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class FilmFilter extends AbstractFilter
{
    public const TITLE = 'title';
    public const GENRE_ID = 'genre_id';
    public const ARTIST_ID = 'artist_id';


    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::GENRE_ID => [$this, 'genreId'],
            self::ARTIST_ID => [$this, 'artistId'],
        ];
    }

    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%");
    }

    public function genreId(Builder $builder, $value)
    {
        $builder->where('genre_id', $value);
    }

    public function artistId(Builder $builder, $value)
    {
        $builder->whereHas('artists', function ($q) use ($value) {
            $q->where('artist_id', $value);
        });
    }
}
