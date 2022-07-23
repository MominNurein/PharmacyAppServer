<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $delivery = Delivery::all();
            return response()->json(['status' => true ,'data' => $delivery]);
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
    public function store(Request $request , $id)
    {
        try {
            $delivery = Delivery::create([
                'user_id' => $request -> user_id ,
                'pharmacy_id' => $request -> pharmacy_id ,
                'order_id' => $request -> order_id ,
                'latitude' => $request -> latitude ,
                'longitude' => $request -> longitude
            ]);

            if ($delivery) {
                return response()->json(['status' => true , 'msg' => "Delivery started !"]);
            } else {
                return response()->json(['status' => false , 'msg' => "something went wrong !"]);
            }
            
        } catch(Exception $exp_msg) {
            return response()->json(['status' => false , 'msg' => $exp_msg]);
        }
    }

    // to update delicery status arrived or not ?
    public function update($id)
    {
        try {
            $delivery = Delivery::find($id);
            if ($delivery) {

                if ($delivery -> status = 0) {
                    $delivery ->status = 1;
                    $delivery ->save();
                    return response()->json(['status'=> true , 'msg' => "delivery arrived"]);
                } else {
                    return response()->json(['status'=> true , 'msg' => "delivery already on way !"]);
                }
                
            } else {
                return response()->json(['status'=> false , 'msg' => 'Delivery order with id '. $id . ' is not found !']);
            }
        } catch(Exception $exp) {
            return response()->json(['status' => false , 'msg' => $exp], $headers);
        }
    }

    public function getLocation($id) {
        $itudes = DB::table('delivery') -> select('longitude' , 'latitude') -> where('id' , $id) -> get();
        return $itudes;
    }

    public function updateLocation(Request $request , $id) {

        $delivery = Delivery::find($id);

        if ($delivery) {
            $delivery -> longitude = $request -> longitude;
            $delivery -> latitude = $request -> latitude;

            $delivery -> save();
            $updatedLocation = [$delivery->longitude , $delivery -> latitude];
            return response()->json(['status' => true , 'updatedLocation' => $updatedLocation]);  
        } else {
            return response()->json(['status' => false , 'msg' => 'delivery with id ' . $id . ' is not found .']);
        }     
    }
}
