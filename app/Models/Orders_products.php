<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders_products extends Model
{
	protected $fillable = [
	    'order_id', 'product_id', 'qty'
    ];
}
