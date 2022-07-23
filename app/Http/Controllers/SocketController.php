<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Socket;
use App\Models\Delivery;
use Illuminate\Support\Facades\DB;

class SocketController extends Controller
{
    public static function getLocation($id) {
        $delivery = Delivery::find($id);

        if(!$delivery) {
            return response()->json(['status' => false , 'msg' => 'delivery with id '. $id . ' is not found .']);
        } else {
            $longitude = $delivery -> longitude;
            $latitude = $delivery -> latitude;
            Socket::getLocation( $longitude ,$latitude);
        }
    }
    public function setLocation(Request $request , $deliveryId)
    {
        sleep(3);
        return $request->all();
        $delivery = DB::table('delivery') -> where('id' , $deliveryId) -> first();
        if (!$delivery) {
            return response()->json(['status' => false , 'msg' => 'delivery not found']);
        } else {            
            $delivery = DB::table('delivery')-> where('id' , $deliveryId)->first();
            $affected_rows = DB::table('delivery') -> where('id' , $deliveryId) -> update([
                'latitude' => $request -> latitude,
                'longitude' => $request -> longitude
            ]);
            Socket::setLocation($delivery -> longitude , $delivery -> latitude , $deliveryId);
            return response()->json(['status' => $affected_rows , 'request' => $request -> all()]);
        }
    }
}
