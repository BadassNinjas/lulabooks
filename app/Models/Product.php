<?php

namespace App\Models;

use BadassNinjas\BadassModel;

class Product extends BadassModel
{
    public $table = 'product';

    protected $schema = [
      'name' => [
        'type' => 'string',
        'length' => 64,
      ],
      'price' => [
        'type' => 'decimal',
        'length' => '32'
      ],
      'description' => [
        'type' => 'string',
        'length' => '16000',
        'modifiers' => [
          'nullable',
        ]
      ]
    ];
}
