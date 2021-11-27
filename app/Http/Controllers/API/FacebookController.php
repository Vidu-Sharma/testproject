<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Socialite;
use Auth;
use Exception;
use App\User;
use Session;

class FacebookController extends Controller
{
     
  public function redirect() 
   {
    return Socialite::driver('facebook')->stateless()->user();

 
   }
    public function callback(User $service) 
   {
    // $user = $service->createOrGetUser(Socialite::driver('facebook')->user());

    //     auth()->login($user);
    //     Session::set('user', $this->user->toArray());
    //     return response()->json($user);
       $usr = Socialite::driver('facebook')->stateless()->user();
       $success = $usr->token-> accessToken;
             $finduser = User::where('email', $usr->email)->first();
            if ($finduser) {
                Auth::login($finduser);
                 return response()->json(['status'=>200,'success' => $success,'user'=>$usr], $this-> successStatus); 
           }
           else{
        $user = new User;
        $user->name=$usr->name;
         $user->email=$usr->email;
         $user->facebook_id=$usr->id;
        $user->last_name=$usr='';
       
        $user->password=$usr='';
        
        $user->profile_image=$usr='';
        $user->save();
          $success = $user->token-> accessToken;
         return response()->json(['status'=>200,'success' => $success,'user'=>$user], $this-> successStatus); 
   }
   }
}
