<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vinyl;

class VinylSeeder extends Seeder
{
    public function run()
    {
        $vinyl = Vinyl::create([
            'name'=> 'Electric Ladyland',
            'author'=> 'Jimi Hendrix',
            'description'=> 'Lorem ipsum',
            'price'=> 27.99,
            'qty'=> 30,
        ]);
        $vinyl = Vinyl::create([
            'name'=> 'Eclipse',
            'author'=> 'Twin Shadow',
            'description'=> 'Lorem ipsum',
            'price'=> 25.00,
            'qty'=> 100,
        ]);
    }
}