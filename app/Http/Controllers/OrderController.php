<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $order = Order::all();
            return response()->json(['status' => true ,'data' => $order]);
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
            $order = Order::create([
                'user_id' => $request -> user_id ,
                'cart_id' => $request -> cart_id ,
                'address' => $request -> address ,
                'phone' => $request -> phone ,
            ]);

            if ($order) {
                return response()->json(['status' => true , 'msg' => "Order created successfully !"]);
            } else {
                return response()->json(['status' => false , 'msg' => "something went wrong !"]);
            }
        } catch(Exception $exp_msg) {
            return response()->json(['status' => false , 'msg' => $exp_msg]);
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
            $order = Order::find($id);

            if ($order) {
                return response()->json(['status'=> true , 'data' => $order]);
            } else {
                return response()->json(['status'=> false , 'msg' => 'Order with id '. $id . ' is not found !']);
            }
        } catch(Exception $exp) {
            return response()->json(['status' => false , 'msg' => $exp], $headers);
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
            $order = Order::find($id);

            if ($order) {
                $order -> delete();
                return response()->json(['status' => true , 'msg' => 'Order Deleted !']);
            } else {
                return response()->json(['status' => false , 'msg' => 'Order not found !']);
            }

        } catch (\Throwable $th) {
            return response()->json(['status' => false , 'msg' => $th]);
        }
    }
}
