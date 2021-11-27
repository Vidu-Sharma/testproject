<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Validator;
class Products extends Controller
{

   
   public function index ()
    {
     $product= Product::all();
     return response()->json($product);
    
    }
   
    public function save(Request $req){
        
           
        $valid = Validator::make($req->all(),[
         'product_name'=>"required",
         'product_description'=>"required",
         'product_color'=>"required",
         'product_sell'=>"required",
        ]);
        if($valid -> fails()){
            return response()->json(['error'=>$valid->errors()],401);
        }
          // $checkBox = implode(',', $_POST['product_sell']);
        $product = new Product;
        $product->product_name=$req->product_name;
        $product->product_description=$req->product_description;
        $product->product_color=$req->product_color;
        if(!empty($req->product_sell)){
                $product_sell = implode(",", $req->product_sell);
                $product->product_sell = $product_sell;
            }
     
        if($product->save()){
        return response()->json($product);
        }
    }
    public function showbyid($id){
        
        $product = Product::find($id);
     
        return response()->json($product);
    }
    public function update(Request $req, $id){
            $product=Product::find($id);
        $product->update($req->all());
        return response()->json($product);

    }
    
   public function deletebyid(Request $request,$id){
       
         $product = Product::find($id);
       $product->delete();
        return response()->json($product);
        // $validator = Validator::make($request->all(), [
        //     'id' => 'required',
        // ]);        
        // if($validator->fails()){
        //     return $this->respondWithError($validator->messages()->first(),411);
        // }else{
        //     $data = Product::find($id);
        //     if(!empty($data)){
        //         $data->delete();
        //         return response()->json([
        //             'data'   => $data,
        //             'message'   => "Product deleted successfully.",
        //             'Error'   => false,
        //             'status_code'   => 200
        //         ]);
        //     }else{
        //         return response()->json([
        //             'data'   => array(),
        //             'message'   => "Product Failed to delete.",
        //             'Error'   => true,
        //             'status_code'   => 403
        //         ],403);
        //     }
        // }
    }
}

