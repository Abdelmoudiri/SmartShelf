<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\AssignOp\Concat;

class ProductController extends Controller
{
    // Create
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2',
            'description' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'unit_price' => 'required|numeric|min:0.01',
            'id_rayon' => 'required|integer|min:1',
            'promotion' => 'nullable|integer|min:0|max:99',
            'is_popular' => 'nullable|boolean',
            'stock' => 'required|integer|min:1',
            'min_stock' => 'required|integer|min:0',
        ]);

        if($validator->fails()){
            return response([
                'message' => 'Invalid Informations'
            ]);
        }

        $validatedData = $validator->validate();

        $product = Product::create($validatedData);

        return response()->json([
            'message' => 'Produit créé avec succès',
            'category' => $product,
        ], 201);
    }

    // get All
    public function index()
    {
        $products = DB::table('products')
            ->join('rayons', 'rayons.id', '=', 'products.id_rayon')
            ->join('categories', 'rayons.id_category', '=', 'categories.id')
            ->select(
                'products.name',
                'products.description',
                'products.marque',
                'categories.name as category_name',
                'rayons.numero as rayon_number',
                'products.unit_price',
                'products.promotion',
                'products.is_popular',
                'products.stock',
                'products.min_stock'
            )
            ->get();
        return response()->json($products, 200);
    }

    // // show One
    public function show($id){
        $product = DB::table('products')
            ->join('rayons', 'rayons.id', '=', 'products.id_rayon')
            ->join('categories', 'rayons.id_category', '=', 'categories.id')
            ->select(
                'products.name',
                'products.description',
                'products.marque',
                'categories.name as category_name',
                'rayons.numero as rayon_number',
                'products.unit_price',
                'products.promotion',
                'products.is_popular',
                'products.stock',
                'products.min_stock'
            )->where('products.id','=',$id)
            ->get();
        return response()->json($product, 200);
    }

    // // delete
    public function destroy($id){
        $product = DB::table('products')
                    ->where('id','=',$id)
                    ->delete();
        return response()->json([
            "message" => "Plroduits Supprimé avec Succés !" 
        ]);
    }

    //update
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|min:2',
            'description' => 'nullable|string|max:255',
            'marque' => 'nullable|string|max:255',
            'unit_price' => 'nullable|numeric|min:0.01',
            'id_rayon' => 'nullable|integer|min:1',
            'promotion' => 'nullable|integer|min:0|max:99',
            'is_popular' => 'nullable|boolean',
            'stock' => 'nullable|integer|min:1',
            'min_stock' => 'nullable|integer|min:0',
        ]);

        if($validator->fails()){
            return response([
                'message' => 'Champs Invalides !'
            ]);
        }

        $validatedData = $validator->validate();


        DB::table('products')
            ->where('id', $id)
            ->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'marque' => $validatedData['marque'],
                'unit_price' => $validatedData['unit_price'],
                'id_rayon' => $validatedData['id_rayon'],
                'promotion' => $validatedData['promotion'],
                'is_popular' => $validatedData['is_popular'],
                'stock' => $validatedData['stock'],
                'min_stock' => $validatedData['min_stock'],
            ]);
        
        $product = self::show($id);

        return response()->json([
            'message' => 'Produit mis à jour avec succès',
            'produit' => $product,
        ], 201);
    }


    // show Popular Products
    public function popular(){
        $products = DB::table('products')
            ->join('rayons', 'rayons.id', '=', 'products.id_rayon')
            ->join('categories', 'rayons.id_category', '=', 'categories.id')
            ->where('products.is_popular','=',true)
            ->select(
                'products.name',
                'products.description',
                'products.marque',
                'categories.name as category_name',
                'rayons.numero as rayon_number',
                'products.unit_price',
                'products.promotion',
                'products.is_popular',
                'products.stock',
                'products.min_stock'
            )
            ->get();
        return response()->json($products, 200);
    }


    // show Promoted Products
    public function promoted(){
        $products = DB::table('products')
            ->join('rayons', 'rayons.id', '=', 'products.id_rayon')
            ->join('categories', 'rayons.id_category', '=', 'categories.id')
            ->where('products.promotion','>',0)
            ->select(
                'products.name',
                'products.description',
                'products.marque',
                'categories.name as category_name',
                'rayons.numero as rayon_number',
                'products.unit_price',
                'products.promotion',
                'products.is_popular',
                'products.stock',
                'products.min_stock',
            )->get()
            ->map(function ($product) {
                $product->price_after_promotion = $product->unit_price * (1 - $product->promotion / 100);
                return $product;
            });
    
        return response()->json([
            'products' => $products
        ], 200);
    }

    // search Products by Name or by Category
    public function search(Request $request){
        $products = DB::table('products')
                    ->join('rayons', 'rayons.id', '=', 'products.id_rayon')
                    ->join('categories', 'rayons.id_category', '=', 'categories.id')
                    ->where(function ($query) use ($request) {
                        $query->where('products.name', 'LIKE', "%{$request->search}%")
                              ->orWhere('categories.name', 'LIKE', "%{$request->search}%");
                    })
                    ->select(
                        'products.name',
                        'products.description',
                        'products.marque',
                        'categories.name as category_name',
                        'rayons.numero as rayon_number',
                        'products.unit_price',
                        'products.promotion',
                        'products.is_popular',
                        'products.stock',
                        'products.min_stock',
                    )->get();
        
        return response()->json($products, 200);
    }

}
