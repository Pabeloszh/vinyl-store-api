<?php

namespace App\Http\Controllers;
use App\Models\Vinyl;
use Illuminate\Http\Request;

class VinylController extends Controller
{
    protected $stringParams = ['name', 'author'];
    protected $numberParams = ['price'];

    protected $indexReturned = ['id', 'name', 'author', 'price', 'created_at'];

    public function index(Request $request)
    {
        $query = $request->query();
        $queryParams = [];

        // string params
        foreach($this->stringParams as $string){
            if(isset($query[$string])){
                array_push($queryParams, [$string, 'ilike', '%'.$query[$string].'%']);
            };
        }

        // number params
        foreach($this->numberParams as $number){
            if(isset($query[$number.'Lte'])){
                array_push($queryParams, [$number, '<=', $query[$number.'Lte']]);
            };
            if(isset($query[$number.'Gte'])){
                array_push($queryParams, [$number, '>=', $query[$number.'Gte']]);
            };
        }

        // pagination limit
        $limit = isset($query['limit']) ? $query['limit'] : 12;

        return Vinyl::where($queryParams)->paginate($limit, $this->indexReturned);
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
        return Vinyl::find($id);
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