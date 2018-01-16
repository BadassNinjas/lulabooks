<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookProduct extends Model
{
  
  protected $table = "book_product";

  protected $fillable = [
      'product_id',
      'grade',
      'in_stock',
  ];
  public function product(){
    return $this->belongsTo('App\Models\Product','product_id');
  }
}
