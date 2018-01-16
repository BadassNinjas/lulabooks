<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use BadassNinjas\Migrator\Traits\MigratorTrait;

class StationeryProduct extends Model
{
  use MigratorTrait;

  public $table = 'stationery_product';

  protected $schema = [
    'product_id' => [
      'type' => 'string',
      'length' => 128,
    ],
    'in_stock' => [
      'type' => 'string',
      'length' => 32,
      'modifiers' => [
        'default' => '1',
      ],
    ],
  ];
  protected $fillable = [
      'product_id',
      'in_stock',
  ];
  public function product(){
    return $this->belongsTo('App\Models\Product','product_id');
  }
}
