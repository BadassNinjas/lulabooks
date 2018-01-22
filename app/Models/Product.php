<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = 'product';

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

    public function bookproduct()
    {
        return $this->hasMany('App\Models\BookProduct');
    }

    public function stationeryproduct()
    {
        return $this->hasOne('App\Models\StationeryProduct');
    }

    public function images()
    {
        return $this->belongsToMany('App\Models\ProductImage');
    }
}
