<?php

namespace App\Http\Controllers;
use App\Models\Vinyl;
use Illuminate\Http\Request;


class VinylController extends Controller
{
    protected $stringParams = ['name', 'author'];
    protected $numberParams = ['price'];
    protected $relationParams = [
        ['genre', 'name'],
    ];

    protected $indexReturned = ['id', 'name', 'author', 'price', 'genre_id'];

    public function index(Request $request)
    {
        $query = $request->query();

        $limit = isset($query['limit']) ? $query['limit'] : 12;

        return Vinyl::with('genre:id,name')
        ->filterByNumber($query, $this->numberParams)
        ->filterByString($query, $this->stringParams)
        ->filterByRelation($query, $this->relationParams)
        ->paginate($limit, $this->indexReturned);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'qty' => 'required'
        ]);

        return Vinyl::create($request->all());
    }

    public function show($id)
    {
        return Vinyl::with('genre:id,name')->find($id);
    }

    public function update(Request $request, $id)
    {
        $vinyl = Vinyl::find($id);
        $vinyl->update($request->all());

        return $vinyl;
    }

    public function destroy($id)
    {
        Vinyl::destroy($id);

        return 'vinyl deleted from db';
    }
}