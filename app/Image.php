<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use App\Product;

class Image extends Model
{
  
    
    protected $fillable = [
       'product_id',
       'image',
        
        ];
        public function product(){
            return $this->belongsTo(Product::class);
        }
 }  


