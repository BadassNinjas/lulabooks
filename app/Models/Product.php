<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use BadassNinjas\Migrator\Traits\MigratorTrait;

class Product extends Model
{
    use MigratorTrait;

    public $table = 'product';

    protected $schema = [
      'name' => [
        'type' => 'string',
        'length' => 64,
      ],
      'caption' => [
        'type' => 'string',
        'length' => 512,
      ],
      'price' => [
        'type' => 'decimal',
        'length' => '12',
      ],
      'detail' => [
        'type' => 'string',
        'length' => '16000',
        'modifiers' => [
          'nullable',
        ],
      ],
    ];
    protected $pivots = [
        ProductImage::class,
    ];
    protected $fillable = [
        'name',
        'caption',
        'price',
        'detail',
    ];
    protected $with = [
      'images',
    ];
    protected $appends = [
      'category',
    ];
    public function getCategoryAttribute($value)
    {
        if (!is_null($this->category())) {
            return $this->category()->first();
        }

        return null;
    }
    public function category()
    {
        return $this->belongsToMany('App\Models\ProductCategory');
    }
    public function categories()
    {
        return $this->belongsToMany('App\Models\ProductCategory');
    }
    public function images()
    {
        return $this->belongsToMany('App\Models\ProductImage');
    }
}
