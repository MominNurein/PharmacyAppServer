<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pharmacy;

class PharmacyController extends Controller
{
    public function index()
    {
        try {
            $pharmacies = Pharmacy::with('products')->get();
            return response()->json(['status' => true ,'data' => $pharmacies], 400);
        } catch(Exception $exp) {
            return response()->json(['status' => false , 'msg' => $exp]);
        }
    }
    public function store(Request $request)
    {
        try {
            $checkPharmacy = Pharmacy::where('name' , $request->name)->first(); 

            if ($checkPharmacy) {
                return response()->json(['status' => false , 'msg' => "Pharmacy is already exist !"]);
            } else {
                $pharmacy = Pharmacy::create([
                    'name' => $request -> name ,
                    'address' => $request -> address
                ]);

                if ($pharmacy) {
                    return response()->json(['status' => true , 'msg' => "Pharmacy created successfully !"], 200);
                } else {
                    return response()->json(['status' => false , 'msg' => "something went wrong !"], 400);
                }
            }
        } catch(Exception $exp_msg) {
            return response()->json(['status' => false , 'msg' => $exp_msg], 400);
        }
    }

    public function show($id)
    {
        try {
            $pharmacy = Pharmacy::with('products')->find($id);

            if ($pharmacy) {
                return response()->json(['status'=> true , 'data' => $pharmacy]);
            } else {
                return response()->json(['status'=> false , 'msg' => 'pharmacy with id '. $id . ' is not found !']);
            }
        } catch(Exception $exp) {
            return response()->json(['status' => false , 'msg' => $exp], 200, $headers);
        }
    }

    public function destroy($id)
    {
        try {
            $pharmacy = Pharmacy::find($id);

            if ($pharmacy) {
                $pharmacy -> delete();
                return response()->json(['status' => true , 'msg' => 'pharmacy Deleted !']);
            } else {
                return response()->json(['status' => false , 'msg' => 'pharmacy not found !']);
            }

        } catch (\Throwable $th) {
            return response()->json(['status' => false , 'msg' => $th]);
        }
    }
}
