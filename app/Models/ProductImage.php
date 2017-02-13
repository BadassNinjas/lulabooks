<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use BadassNinjas\Migrator\Traits\MigratorTrait;

class ProductImage extends Model
{
    use MigratorTrait;

    public $table = 'product_image';

    protected $schema = [
      'external_id' => [
        'type' => 'bigInteger',
      ],
      'hostname' => [
        'type' => 'string',
        'length' => 255,
      ],
      'path' => [
        'type' => 'string',
        'length' => 255,
      ],
    ];

    protected $hidden = [
      'products',
    ];

    protected $appends = [
      'url',
    ];

    public function getUrlAttribute($value)
    {
        return "https://{$this->hostname}{$this->path}";
    }

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
        parent::delete();
    }
}
