<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class HasSideDish extends Model
{
    protected $table = 'product_has_side_dish';

    protected $fillable = [
    	'product_id',
    	'side_dish_id'
    ];

    public function side_dish() {
    	return $this->hasOne(SideDish::class, 'id', 'side_dish_id');
    }
}
