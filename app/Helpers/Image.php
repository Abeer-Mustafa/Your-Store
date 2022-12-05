<?php

use Illuminate\Http\Request;
use App\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\Orders_products;

// ===== Upload new image =====
// ============================
function upload(Request $request, $extends, $parent){
	foreach ($request->file('images') as $imgg) {
		$fileName = uniqid($extends).'.'.$imgg->getClientOriginalExtension();
		$imgg->move(storage_path().'/images/',$fileName);
        $img= new Image;
		$img->parent = $parent;
		$img->extends = $extends;
        $img->name = $fileName;
    	$img->save();
	}
}

// ===== Delete old image =====
// ============================
function delete($extends, $parent){
	$images = Image::where('extends',$extends)->where('parent',$parent);
	if(count($images->get()) > 0) {
		$imgFile = storage_path('images/'.$images->first()->name);
		if(file_exists($imgFile))
			@unlink($imgFile);
	}
	$images->delete();
}

// ==== Show Image for {extends} Table and {parent} Item
// =====================================================
function Show($extends, $parent) {
	$file = Image::where('extends',$extends)->where('parent',$parent)->get();
	if(count($file) > 0)
		return url('storage/images/'.$file->first()->name);
	else
		return url('images/no-image.png');
}

