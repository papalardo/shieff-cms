<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class SideDish extends Model
{
    protected $table = 'product_side_dish';

    protected $fillable = [
    	 	'name',
				'description',
				'price'
    ];
}
