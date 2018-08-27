<?php

namespace App\Models\Order\Product;

use Illuminate\Database\Eloquent\Model;

class HasSideDish extends Model
{
    protected $table = 'order_has_side_dish';

    protected $fillable = [
        'order_product_id',
        'side_dish_id'
    ];

    public function sideDish()
    {
        return $this->hasOne(\App\Models\Product\SideDish::class, 'id', 'side_dish_id');
    }
}
