<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;


class OrderController extends Controller
{
    // Pass Order
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'id_product' => 'required|integer',
            'id_custumor' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        if($validator->fails()){
            return response([
                'message' => 'Invalid Order Informations'
            ]);
        }

        $validatedData = $validator->validate();

        $product = Product::findOrFail($validatedData['id_product']);

        if($product->stock < $validatedData['quantity']){
            return response(['message' => 'La quantité choisie n\'est pas disponible en Stock !']);
        }

        $order = Order::create([
            'id_product' => $validatedData['id_product'],
            'id_custumor' => $validatedData['id_custumor'],
            'quantity' => $validatedData['quantity'],
            'total_price' => $product->unit_price * (1 - $product->promotion/100) * $validatedData['quantity'],
        ]);
        
        $product->stock -= $validatedData['quantity'];
        $product->save();

        return response()->json([
            'message' => 'Commande passée avec succès',
            'Commande' => $order,
        ], 201);
    }

    // show All Orders
    public function index(){
        $orders = DB::table('orders')
            ->join('products', 'products.id', '=', 'orders.id_product')
            ->join('users', 'orders.id_custumor', '=', 'users.id')
            ->select(
                'orders.id',
                'products.name',
                'users.name',
                'orders.quantity',
                'orders.total_price',
            )
            ->get();
        return response()->json($orders, 200);
    }
}
