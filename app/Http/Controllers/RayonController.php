<?php

namespace App\Http\Controllers;

use App\Models\Rayon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RayonController extends Controller
{
   
    // Create
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'numero' => 'required|integer|min:1|unique:rayons',
            'places' => 'required|integer|min:1',
            'id_category' => 'required|integer'
        ]);

        if($validator->fails()){
            return response([
                'message' => 'Champs Invalides !'
            ]);
        }

        $validatedData = $validator->validate();

        $rayon = Rayon::create($validatedData);

        return response()->json([
            'message' => 'Rayon créé avec succès',
            'rayon' => $rayon,
        ], 201);
    }

    // get All
    public function index(){
        $rayons = Rayon::with('category')->get();
        return response()->json($rayons->map(function($rayon) {
            return [
                "numero" => $rayon->numero,
                "places" => $rayon->places,
                "category" => $rayon->category->name,
            ];
        }), 200);
    }

    // show One
    public function show(Rayon $rayon){
        return response()->json($rayon);
    }

    // delete
    public function destroy(Rayon $rayon){
        $rayon->delete();
        return response()->json([
            "message" => "Rayon Supprimé avec Succés !" 
        ]);
    }

    //update
    public function update(Request $request, Rayon $rayon){
        $validator = Validator::make($request->all(), [
            'numero' => 'nullable|integer|min:1|unique:rayons',
            'places' => 'nullable|integer|min:1',
            'id_category' => 'nullable|integer'
        ]);

        if($validator->fails()){
            return response([
                'message' => 'Champs Invalides !'
            ]);
        }

        $validatedData = $validator->validate();


        if ($request->has('numero')) {
            $rayon->numero = $validatedData['numero'];
        }
    
        if ($request->has('places')) {
            $rayon->places = $validatedData['places'];
        }
    
        if ($request->has('id_category')) {
            $rayon->id_category = bcrypt($validatedData['id_category']);
        }
    
        $rayon->save();

        return response()->json([
            'message' => 'Rayon mis à jour avec succès',
            'rayon' => $rayon,
        ], 201);
    }

}
