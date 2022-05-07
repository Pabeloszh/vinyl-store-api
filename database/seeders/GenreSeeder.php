<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    protected $genres = ['blues', 'classical', 'country', 'disco', 'jazz', 'hiphop', 'metal', 'pop', 'rock', 'reggae'];

    public function run()
    {
        foreach($this->genres as $genre){
            Genre::create([
                'name'=> $genre,
            ]);
        }
    }
}