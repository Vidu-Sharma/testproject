<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ROLECONTROLLER extends Controller
{
    //
        public function show()
    {
        // 
         $roles = DB::table('roles')->get();
        return view('roleshow',['roles'=>$roles]);
    }

        public function index()
    {
        // 
        $roles = DB::table('roles')->get();
        return view('addrole',['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        DB::table('roles')->insert([
        'title' => $request->add_role_name,
        ]);
        return redirect(route('roleshow'));
       
    }
       public function edit($id)
    {
        //
        $roles = DB::table('roles')->find($id);
        return view('editrole',['roles'=>$roles]);
    }
       public function update(Request $request, $id)
    {
        //
        DB::table('roles')->where('id',$id)->update([
          'title' => $request->add_role_name,
        ]);
         return redirect(route('roleshow'));
    }
     public function destroy($id)
    {
        //
        DB::table('roles')->where('id',$id)->delete();
        return redirect(route('roleshow'))->with('status','role deleted');
    }
    public function user_list(){
         $users = DB::table('users')->get();
         return view('admin_user_list',['users'=>$users]);
    }
       public function edit_user_list($id)
    {
        //
        $roles = DB::table('roles')->get();
        $users = DB::table('users')->find($id);
        return view('edit_user_list',['users'=>$users,'roles'=>$roles]);
    }
      public function update_user_list(Request $request, $id)
    {
        //
        
        DB::table('users')->where('id',$id)->update([
          'name' => $request->name,
         'email' => $request->email,
         'role' =>$request->role,
        ]);
         return redirect(route('userlist'));
    }
 public function destroy_user($id)
    {
        //
        DB::table('users')->where('id',$id)->delete();
        return redirect(route('userlist'))->with('status','user deleted');
    }


}
