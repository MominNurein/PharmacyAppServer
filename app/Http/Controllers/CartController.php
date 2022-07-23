<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $cart = Cart::with('orders')->get();
            return response()->json(['status' => true ,'data' => $cart]);
        } catch(Exception $exp) {
            return response()->json(['status' => false , 'msg' => $exp]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $cart = Cart::create([
                'product_id' => $request -> product_id ,
                'qty' => $request -> qty
            ]);

            if ($cart) {
                return response()->json(['status' => true , 'msg' => "Cart created successfully !"], 200);
            } else {
                return response()->json(['status' => false , 'msg' => "something went wrong !"], 400);
            }
            
        } catch(Exception $exp_msg) {
            return response()->json(['status' => false , 'msg' => $exp_msg], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         try {
            $cart = Cart::with('orders')->find($id);

            if ($cart) {
                return response()->json(['status'=> true , 'data' => $cart]);
            } else {
                return response()->json(['status'=> false , 'msg' => 'Cart with id '. $id . ' is not found !']);
            }
        } catch(Exception $exp) {
            return response()->json(['status' => false , 'msg' => $exp]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       try {
            $cart = Cart::find($id);

            if ($cart) {
                $cart -> delete();
                return response()->json(['status' => true , 'msg' => 'Cart Deleted !']);
            } else {
                return response()->json(['status' => false , 'msg' => 'Cart not found !']);
            }

        } catch (\Throwable $th) {
            return response()->json(['status' => false , 'msg' => $th]);
        }
    }
}
