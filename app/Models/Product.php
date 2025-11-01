<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;


        protected $fillable=['name','category_id','price'];

        public function category(){
            return $this->belongsTo(Product::class);
        }
    //
}
