<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            return response()->json(['status' => true ,'data' => $users]);
        } catch(\Throwable $exp) {
            return response()->json(['status' => false , 'msg' => $exp]);
        }
    }

    public function store(Request $request) 
    {
        try {

            $checkUser = User::where('name' , $request->name)->first(); 

            if ($checkUser) {
                return response()->json(['status' => false , 'msg' => "User is already exist !"]);
            } else {
                $user = User::create([
                    'name' => $request -> name ,
                    'password' => Hash::make($request -> password)
                ]);

                if ($user) {
                    return response()->json(['status' => true , 'msg' => "user created successfully !"]);
                } else {
                    return response()->json(['status' => false , 'msg' => "something went wrong !"]);
                }
            }
        } catch(\Throwable $exp_msg) {
            return response()->json(['status' => false , 'msg' => $exp_msg]);
        }
    }

    public function show($id)
    {
        try {
            $user = User::find($id);

            if ($user) {
                return response()->json(['status'=> true , 'data' => $user]);
            } else {
                return response()->json(['status'=> false , 'msg' => 'User with id '. $id . ' is not found !']);
            }
        } catch(\Throwable $exp) {
            return response()->json(['status' => false , 'msg' => $exp], $headers);
        }

    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);

            if ($user) {
                $user -> delete();
                return response()->json(['status' => true , 'msg' => 'User Deleted !']);
            } else {
                return response()->json(['status' => false , 'msg' => 'User not found !']);
            }

        } catch (\Throwable $th) {
            return response()->json(['status' => false , 'msg' => $th]);
        }
    }
}
