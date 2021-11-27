<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Donor;
use App\User;
use Validator;
class DonorController extends Controller
{ 
     public $successStatus = 200;

     public function index ()
    {
     $donors= Donor::all();
     return response()->json($donors);
    
    }
     public function save(Request $req){
         //echo "<pre>"; print_r($user->id); echo "</pre>"; die();
        $valid = Validator::make($req->all(),[
         
         'address'=>"required",
         'lat'=>"required",
         'lon'=>"required",
         'accepts'=>"required",
        ]);
        if($valid -> fails()){
            return response()->json(['error'=>$valid->errors()],401);
        }
        
        $donors = new Donor;
       
        $donors->address=$req->address;
        $donors->lat=$req->lat;
        $donors->lon=$req->lon;
        $donors->accepts=$req->accepts;
        $user = User::orderBy('id','DESC')->first();
        $donors->user_id=$user->id;
        if($donors->save()){
         if(!empty($donors)){
                return response()->json([
                    'data'   => $donors,
                    'message'   => "donors created successfully",
                    'Error'   => false,
                    'status_code'   => 200
                ]);
            }else{
                return response()->json([
                   
                    'message'   => "donors not inserted",
                    'Error'   => false,
                    'status_code'   => 204
                ]);
            }
        }
    }
     public function showbyid($id){
        
        $donors = Donor::find($id);
     
        return response()->json($donors);
      

    }
    public function update(Request $req, $id)
    {
        $donor=Donor::find($id);
        if(!empty($req->address)){
            $donor->address=$req->address;
        }
        if(!empty($req->lat)){
            $donor->lat=$req->lat;
        }
        if(!empty($req->lon)){
           $donor->lon=$req->lon;
        }
        if(!empty($req->accepts)){
           $donor->accepts=$req->accepts;
        }        
        $donor->update();
        return response()->json($donor);

    }
     public function deletebyid(Request $request,$id){
       
         $donors = Donor::find($id);
       $donors->delete();
            if(!empty($donors)){
                return response()->json([
                    'data'   => $donors,
                    'message'   => "donor deleted sccessfully",
                    'Error'   => false,
                    'status_code'   => 200
                ]);
            }else{
                return response()->json([
                   
                    'message'   => "donor not deleted",
                    'Error'   => false,
                    'status_code'   => 204
                ]);
            }
       
    }
}
