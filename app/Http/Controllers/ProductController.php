<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Image;
use App\Product;
use Hash;
use Auth;
// use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
     public function show()
    {
        $product=Product::with('images')->get();
   
       return view('productshow',compact('product'));
    	// 
		// $user_type = Auth::user()->user_type;
		// print_r($user_id);die('asdf');
		// if ($user_type == 'admin') {
			// $product = DB::table('product')->get();
			// return view('productshow',['product'=>$product]);
	  //   // }
	    // else {
     //     return redirect(route('home'))->with('status','Please login Admin user.');

	    // }
    }
       public function index()
    {
        // 
		// $user_type = Auth::user()->user_type;
		// print_r($user_id);die('asdf');
		// if ($user_type == 'admin') {
			$product = DB::table('product')->get();
			return view('product',['product'=>$product]);
	    // }
	    // else {
     //     return redirect(route('home'))->with('status','Please login Admin user.');

	    // }
    }
     public function create()
    {
          
        

    }
    public function store(Request $request){


        // echo "<pre>"; print_r($_POST); echo "</pre>"; 
        $checkBox = implode(',', $_POST['sell']);
        // echo $checkBox; die("chk");
        $product=new product([
        'product_name' => $request->product_name,
        'product_description' => $request->product_description,
        'product_color' => $request->color,
        'product_sell' => $checkBox,
        
         ]);
        $product->save();
        if($request->hasFile("images")){
            $files=$request->file("images");
            foreach($files as $file){
                $imgname=time().'-'.$file->getClientOriginalName();
                // $imgname=str_replace('','_',$imgname);
                
                $request['image']=$imgname;
                $request['product_id']=$product->id;
                $file->move(\public_path("/images"),$imgname);
                Image::create($request->all()); 
            }

         }
        return redirect(route('productshow'))->with('status','product Added');
    }

     public function edit($id)
    {
        //
        $product = DB::table('product')->find($id);
        // echo $product->product_sell; die("chk");
         $checkBox = explode(',', $product->product_sell);
         // print_r($checkBox); die("dsf");
        return view('editproduct',['product'=>$product, 'checkBox'=>$checkBox]);

    }
     
    public function update(Request $request, $id)
    {
        //
         $checkBox = implode(',', $_POST['sell']);
        DB::table('product')->where('id',$id)->update([
           'product_name' => $request->product_name,
        'product_description' => $request->product_description,
        'product_color' => $request->color,
        'product_sell' => $checkBox,
        ]);
         return redirect(route('productshow'))->with('status','product updated');
    }
     public function destroy($id)
    {
        //
        DB::table('product')->where('id',$id)->delete();
        return redirect(route('productshow'))->with('status','product deleted');
    }
}
