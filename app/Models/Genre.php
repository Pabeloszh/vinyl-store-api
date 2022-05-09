<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vinyl;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function vinyls()
    {
        return $this->hasMany(Vinyl::class);
    }
}
