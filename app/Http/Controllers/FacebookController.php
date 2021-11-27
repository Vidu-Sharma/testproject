<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Socialite;
use Auth;
use Exception;
use App\User;
use Carbon\Carbon;
class FacebookController extends Controller
{
     
  public function redirectToFacebook() 
   {
     return Socialite::driver('facebook')->redirect();
   }
    public function handleFacebookCallback() 
   {
       $usr = Socialite::driver('facebook')->stateless()->user();
       print_r($usr->token);
       die();
             $finduser = User::where('email', $usr->email)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/home');
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
        return response()->json($user);
   }
   }
}
