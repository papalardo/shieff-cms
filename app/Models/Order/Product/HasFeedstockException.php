<?php

namespace App\Models\Order\Product;

use Illuminate\Database\Eloquent\Model;

class HasFeedstockException extends Model
{
    protected $table = 'order_has_feedstock_exception';

    protected $fillable = [
        'order_product_id',
        'feedstock_id'
    ];

    public function feedstock()
    {
        return $this->hasOne(\App\Models\Product\Feedstock::class, 'id', 'feedstock_id');
    }
}
