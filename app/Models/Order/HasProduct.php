<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class HasProduct extends Model
{
    protected $table = 'order_has_products';

    protected $fillable = [
        'order_id',
        'product_id',
        'qtd',
        'price',
        'subtotal'
    ];

    public function feedstockException()
    {
        return $this->hasMany(Product\HasFeedstockException::class, 'order_product_id', 'id');
    }

    public function sideDish()
    {
        return $this->hasMany(Product\HasSideDish::class, 'order_product_id', 'id');
    }

    public function product()
    {
        return $this->hasMany(\App\Models\Product\Product::class, 'id', 'product_id');
    }
}
