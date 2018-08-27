<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class HasFeedstock extends Model
{
    protected $table = 'product_has_feedstock';

    protected $fillable = [
    	'product_id',
    	'feedstock_id'
    ];

    public function feedstock() {
    	return $this->hasOne(Feedstock::class, 'id', 'feedstock_id');
    }
}
