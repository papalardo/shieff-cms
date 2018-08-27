<?php

namespace App\Transformers\Product;

use League\Fractal\TransformerAbstract;
use App\Models\Product\Category;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'description' => $category->description
        ];
    }
}
