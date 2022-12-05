<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillable = [
	    'name', 'code', 'brand_id', 'cat_id', 'description', 'stock', 'price', 'discount', 'dioration', 'color', 'size', 'more_info', 'image' 
    ];

    public function category(){
    	return $this->belongsTo(Category::class, 'cat_id');
	}
}
