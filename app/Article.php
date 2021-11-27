<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
     public $table = "article";
    
    protected $fillable = [
          'title',
          'content',
       
        
        ];
}
