<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use Illuminate\Http\Response; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator; 
use Hash;
use Illuminate\Support\Facades\Password;
use Str;
use Carbon\Carbon;
use File;

class UserController extends Controller
{
    //
    public $successStatus = 200;

        // * Register api 
     // * 
     // * @return \Illuminate\Http\Response 
     // */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'last_name' => 'required',
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
$input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;
return response()->json(['success'=>$success], $this-> successStatus); 
    }
    
    public function user() 
    { 
        
        return Auth::user();
         

          
  //echo "<pre>"; print_r($user); echo "</pre>"; die();
       
    } 
    
    public function uploadImage(Request $request){

        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  $user = Auth::User();
 if($request->hasfile('profile_image')){ 
                $file = $request->file('profile_image');
                $file_name = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $imgname = uniqid().$file_name;
                $upload_path = public_path('/users/'); 
                $file->move($upload_path, $imgname);
                $user->profile_image = $imgname;
            }
            $user->save();
          return response()->json([
                    'data'   => $user,
                    'message'   => "image created successfully",
                    'Error'   => false,
                    'status_code'   => 200
                ]);

    }
      public function userprofileupdate(Request $request) 
    { 
          $validatedData = $request->validate([
            'name'  => 'required',
            'last_name'  => 'required',
            'email'  => 'required'
        ]);
              $user = Auth::User();
            if(!empty($request->name)){
                $user->name = $request->name;
            }
            if(!empty($request->last_name)){
                $user->last_name = $request->last_name;
            }
            if(!empty($request->email)){
                $user->email = $request->email;
            }
           $user->save();
           $success['token'] =  $user->createToken('MyApp')-> accessToken; 
                return response()->json(['status'=>200,'success' => $success,'user'=>$user], $this-> successStatus); 
      
    } 
             
    public function showbyid($id){
        
        $user = User::find($id);
     
        return response()->json($user);
    }
    /**
 * @OA\Post(
 * path="/api/login",
 * summary="Sign in",
 * description="Login by email, password",
 * operationId="authLogin",
 * tags={"auth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"email","password"},
 *       @OA\Property(property="email", type="string", format="email", example=""),
 *       @OA\Property(property="password", type="string", format="password", example=""),
 *       @OA\Property(property="persistent", type="boolean", example="true"),
 *    ),
 * ),
 *   @OA\Response(
*     response=200,
*     description="Success",
*     @OA\JsonContent(
*        @OA\Property(property="user", type="string", example="logged in"),
*     )
*  ),
 * @OA\Response(
 *    response=422,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
 *        )
 *     )
 * )
 */
    
    public function login(Request $request){ 
        $request->validate([
            'email' => 'required',
            'password' => 'required',
          
        ]);
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['status'=>200,'success' => $success,'user'=>$user], $this-> successStatus); 
        } 
        else{ 
             return response()->json([
                'errors' => array('message'=>'These credentials do not match our records.')
            ], 401);
        } 
    }

   public function change_password(Request $request)
{
    $input = $request->all();
    $id = Auth::guard('api')->user()->id;
    $userid = $id;
    $rules = array(
        'old_password' => 'required',
        'password' => 'required|min:8',
        'confirm_password' => 'required|same:password',
    );
    $validator = Validator::make($input, $rules);
    if ($validator->fails()) {
        $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
    } else {
        try {
            if ((Hash::check(request('old_password'),Auth::guard('api')->user()->password)) == false) {
                $arr = array("status" => 400, "message" => "Check your old password.", "data" => array());
            } else if ((Hash::check(request('password'), Auth::guard('api')->user()->password)) == true) {
                $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.", "data" => array());
            } else {
                User::where('id', $userid)->update(['password' => Hash::make($input['password'])]);
                $arr = array("status" => 200, "message" => "Password updated successfully.", "data" => array());
            }
        } catch (\Exception $ex) {
            if (isset($ex->errorInfo[2])) {
                $msg = $ex->errorInfo[2];
            } else {
                $msg = $ex->getMessage();
            }
            $arr = array("status" => 400, "message" => $msg, "data" => array());
        }
    }
    return \Response::json($arr);
}
public function forgot_password(Request $request)
{
    $input = $request->all();
    $rules = array(
        'email' => "required|email",
    );
    $validator = Validator::make($input, $rules);
    if ($validator->fails()) {
        $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
    } else {
          
        try {
            $token = Str::random(64);
  
          \DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
             'created_at' => Carbon::now()
              ]);
          \Mail::send('emails.forgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
          return \Response::json(array("status" => 200, "message" => "Mail send successfully", "data" => array()));
        } catch (\Swift_TransportException $ex) {
            $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
        } catch (Exception $ex) {
            $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
        }
    }
    return \Response::json($arr);
}
  public function reset(Request $request)
{
    $input = $request->all();
   
    $rules = array(
        
        'email' => 'required|email|exists:users',
              'password' => 'required|min:8',
        'confirm_password' => 'required|same:password',
    );
    $validator = Validator::make($input, $rules);
    if ($validator->fails()) {
        $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
    } else {
        try {
         
          
           
  
          $updatePassword = \DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
          // echo "<pre>"; print_r($updatePassword->toArray());
          if(!$updatePassword){
             $arr = array("status" => 200, "message" => "Token Invalid", "data" => array());
          }
  
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
         
         $arr = array("status" => 200, "message" => "Password updated successfully.", "data" => array());
            
        } catch (\Exception $ex) {
            if (isset($ex->errorInfo[2])) {
                $msg = $ex->errorInfo[2];
            } else {
                $msg = $ex->getMessage();
            }
            $arr = array("status" => 400, "message" => $msg, "data" => array());
        }
    }
    return \Response::json($arr);
}
}
