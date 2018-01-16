<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StationeryProduct extends Model
{

  public $table = 'stationery_product';

  protected $fillable = [
      'product_id',
      'in_stock',
  ];
  public function product(){
    return $this->belongsTo('App\Models\Product','product_id');
  }
}
