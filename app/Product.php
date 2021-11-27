<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use App\Image;

class Product extends Model
{
    public $table = "product";
    
    public $fillable = [
        'product_name',
        'product_description',
        'product_color',
        'product_sell',
       
        
        ];
        public function images(){
            return $this->hasMany(Image::class,'product_id','id');
        }
   

 }       
