<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
        try {
            $product = Product::with('pharmacy')->get();
            return response()->json(['status' => true ,'data' => $product]);
        } catch(Exception $exp) {
            return response()->json(['status' => false , 'msg' => $exp]);
        }
    }

    public function store(Request $request)
    {
        try {

            $checkProduct = Product::where('name' , $request->name)->first(); 

            if ($checkProduct) {
                return response()->json(['status' => false , 'msg' => "Product is already exist !"]);
            } else {
                // Storing image
                $product;
                if($request->hasFile('image') && $request->image->isValid()) {
                    $image = $request->file('image');
                    $image_name = time().'.'.$image -> getClientOriginalName();
                    $path = $image->storeAs('public',$image_name);
                    $path = substr($path , 7);

                    $product = Product::create([
                        'name' => $request -> name ,
                        'price' => $request -> price ,
                        'qty' => $request -> qty ,
                        'pharmacy_id' => $request -> pharmacy_id ,
                        'image' => $path ,
                    ]);
                } else {
                    $product = Product::create([
                        'name' => $request -> name ,
                        'price' => $request -> price ,
                        'qty' => $request -> qty ,
                        'pharmacy_id' => $request -> pharmacy_id
                    ]);
                }

                if ($product) {
                    return response()->json(['status' => true , 'msg' => "Product created successfully !"]);
                } else {
                    return response()->json(['status' => false , 'msg' => "something went wrong !"]);
                }
                
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
            $product = Product::find($id);

            if ($product) {
                return response()->json(['status'=> true , 'data' => $product]);
            } else {
                return response()->json(['status'=> false , 'msg' => 'Product with id '. $id . ' is not found !']);
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
            $product = Product::find($id);

            if ($product) {
                $product -> delete();
                return response()->json(['status' => true , 'msg' => 'Product Deleted !']);
            } else {
                return response()->json(['status' => false , 'msg' => 'Product not found !']);
            }

        } catch (\Throwable $th) {
            return response()->json(['status' => false , 'msg' => $th]);
        }
    }
}
