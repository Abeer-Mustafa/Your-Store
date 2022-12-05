<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = [
     	'name', 'parent_id', 'image', 'description', 'parent_name'
    ];

 //    public function parent(){
 //        return $this->belongsTo(\App\Models\Category, 'parent_id');
 //    }

 //    public function children(){
 //        return $this->hasMany(Category::class, 'parent_id');
 //    }

	// public function products(){
	//    return $this->hasManyThrough(Product::class, Category::class, 'parent_id', 'cat_id', 'id');
	// }
	// public function childrenRecursive() {
 //    	return $this->children()->with('childrenRecursive');
	// }
}
