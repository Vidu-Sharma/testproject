<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;

use Validator;

class ArticleController extends Controller
{
    public $successStatus = 200;

    public function index ()
    {
     $article= Article::orderBy('id')->paginate(10);
     return response()->json($article);
    
    }
     public function save(Request $req){
         //echo "<pre>"; print_r($user->id); echo "</pre>"; die();
        $valid = Validator::make($req->all(),[
         
         'title'=>"required",
         'content'=>"required",
       
        ]);
        if($valid -> fails()){
            return response()->json(['error'=>$valid->errors()],401);
        }
        
        $article = new Article;
       
        $article->title=$req->title;
        $article->content=$req->content;
   
        if($article->save()){
         if(!empty($article)){
                return response()->json([
                    'data'   => $article,
                    'message'   => "donors created successfully",
                    'Error'   => false,
                    'status_code'   => 200
                ]);
            }else{
                return response()->json([
                   
                    'message'   => "article not inserted",
                    'Error'   => false,
                    'status_code'   => 204
                ]);
            }
        }
    }
}
