<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // get All
    public function index(){
        $clients = User::where('role','custumor')->get();
        return response()->json($clients, 200);
    }

    // show One
    public function show(User $client){
        return response()->json($client);
    }

    // delete
    public function destroy(User $client){
        $client->delete();
        return response()->json([
            "message" => "Client Supprimé avec Succés !" 
        ]);
    }

    //update
    public function update(Request $request, User $client){
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:50', 
            'email' => 'nullable|email|unique:users,email,'. $client->id,
            'password' => 'nullable|min:8'
        ]);

        if($validator->fails()){
            return response([
                'message' => 'Champs Invalides !'
            ]);
        }

        $validatedData = $validator->validate();


        if ($request->has('name')) {
            $client->name = $validatedData['name'];
        }
    
        if ($request->has('email')) {
            $client->email = $validatedData['email'];
        }
    
        if ($request->has('password')) {
            $client->password = bcrypt($validatedData['password']);
        }
    
        $client->save();

        return response()->json([
            'message' => 'Client mis à jour avec succès',
            'client' => $client,
        ], 201);
    }

    // suspend client
    public function suspend($id){
        $client = User::findOrFail($id);
        $client->status = 'Suspended';
        $client->save();

        return response()->json([
            "message" => "Client est Suspendu avec Succès !",
            "client" => $client
        ]);
    }

    // activate client
    public function activate($id){
        $client = User::findOrFail($id);
        $client->status = 'Active';
        $client->save();

        return response()->json([
            "message" => "Client est activé avec Succès !",
            "client" => $client
        ]);
    }
}
