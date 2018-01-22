<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    public $table = 'product_image';

    protected $hidden = [
      'products',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }
    public function delete()
    {
        $product_parents = $this->products;
        if ($product_parents->count()) {
            foreach ($product_parents as $product) {
                $product->images()->detach($this->getKey());
            }
        }
    }
}
