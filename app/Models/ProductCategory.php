<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{

    public $table = 'product_category';

    public $timestamps = false;

    protected $pivots = [
      Product::class,
    ];

    protected $with = [
      'children',
    ];

    protected $appends = [
      'product_count',
    ];
    protected $fillable = [
        'parent_id',
        'sort_order',
        'description',
        'name',
    ];
    public function delete()
    {
        $category_child_keys = $this->children->keyBy('id')->keys();
        if (count($category_child_keys)) {
            self::whereIn('id', $category_child_keys)->update(['parent_id' => $this->parent_id]);
        }
        $category_products = $this->products;
        if ($category_products->count()) {
            foreach ($category_products as $product) {
                $product->categories()->detach($this->getKey());
            }
        }
        parent::delete();
    }
    public function getProductCountAttribute($value)
    {
        return $this->product_count();
    }
    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }
    public function product_count()
    {
        return $this->products()->count();
    }
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->orderBy('sort_order', 'ASC');
    }
    public function parent()
    {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }
}
