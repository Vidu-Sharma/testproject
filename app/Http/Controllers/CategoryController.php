<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
 
   public function show()
    {
        // 
        $categorys = DB::table('categorys')->get();
        return view('categoryshow',['categorys'=>$categorys]);
    }


    public function index()
    {
        // 
        $categorys = DB::table('categorys')->get();
        return view('addcategory',['categorys'=>$categorys]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        DB::table('categorys')->insert([
        'category_name' => $request->category_name,
        ]);
        return redirect(route('categoryshow'))->with('status','Category Added');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function edit($id)
    {
        //
        $category = DB::table('categorys')->find($id);
        return view('edit',['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        DB::table('categorys')->where('id',$id)->update([
          'category_name' => $request->category_name,
        ]);
         return redirect(route('categoryshow'))->with('status','Category updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::table('categorys')->where('id',$id)->delete();
        return redirect(route('categoryshow'))->with('status','Category deleted');
    }
}
