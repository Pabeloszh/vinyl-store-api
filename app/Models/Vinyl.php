<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Builder;

class Vinyl extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'author',
        'description',
        'price',
        'qty',
        'genre_id'
    ];

    protected $hidden = [
        'genre_id'
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function scopeFilterByString($vinyl, $query, $stringArray)
    {
        $queryParams = [];

        foreach($stringArray as $string){
            if(isset($query[$string])){
                array_push($queryParams, [$string, 'ilike', '%'.$query[$string].'%']);
            };
        }

        return $vinyl->where($queryParams);
    }

    public function scopeFilterByNumber($vinyl, $query, $numberArray)
    {
        $queryParams = [];

        foreach($numberArray as $number){
            if(isset($query[$number.'Lte'])){
                array_push($queryParams, [$number, '<=', $query[$number.'Lte']]);
            };
            if(isset($query[$number.'Gte'])){
                array_push($queryParams, [$number, '>=', $query[$number.'Gte']]);
            };
        }

        return $vinyl->where($queryParams);
    }

    public function scopeFilterByRelation($vinyl, $query, $relationArray)
    {
        foreach($relationArray as $relation){
            if(isset($query[$relation[0]])){
                $values = explode(',', $query[$relation[0]]);
                
                return $vinyl->whereHas($relation[0], function (Builder $query) use($relation, $values) {
                    $query->whereIn($relation[1], $values);
                });
            }
        }
    }
}