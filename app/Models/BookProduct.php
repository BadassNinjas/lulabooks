<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use BadassNinjas\Migrator\Traits\MigratorTrait;

class BookProduct extends Model
{
  use MigratorTrait;

  protected $table = "book_product";

  protected $schema = [
    'product_id' => [
      'type' => 'string',
      'length' => 128,

    ],
    'grade' => [
      'type' => 'string',
      'length' => 32,
      'modifiers' => [
        'default' => 'new',
      ],
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
      'grade',
      'in_stock',
  ];
  public function product(){
    return $this->belongsTo('App\Models\Product','product_id');
  }
}
