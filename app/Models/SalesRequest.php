<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use BadassNinjas\Migrator\Traits\MigratorTrait;

class SalesRequest extends Model
{
    use MigratorTrait;

    public $table = 'sales_request';

    protected $schema = [
      'isbn' => [
        'type' => 'string',
        'length' => 128,
        'modifiers' => [
          'nullable',
        ],
      ],
      'firstname' => [
        'type' => 'string',
        'length' => 32,
        'modifiers' => [
          'nullable',
        ],
      ],
      'lastname' => [
        'type' => 'string',
        'length' => 32,
        'modifiers' => [
          'nullable',
        ],
      ],
      'email' => [
        'type' => 'string',
        'length' => 32,
        'modifiers' => [
          'nullable',
        ],
      ],
      'name' => [
        'type' => 'string',
        'length' => 64,
        'modifiers' => [
          'nullable',
        ],
      ],
      'phone' => [
        'type' => 'string',
        'length' => 32,
        'modifiers' => [
          'nullable',
        ],
      ],
      'grade' => [
        'type' => 'string',
        'length' => 32,
        'modifiers' => [
          'nullable',
        ],
      ],
      'price' => [
        'type' => 'decimal',
        'length' => 12,
        'modifiers' => [
          'default' => 0.0,
          'nullable',
        ],
      ],
      'status' => [
        'type' => 'string',
        'length' => 32,
        'modifiers' => [
          'default' => 'UNRESOLVED',
          'nullable',
        ],
      ],
    ];

    protected $fillable = [
      'isbn',
      'firstname',
      'lastname',
      'name',
      'grade',
      'email',
      'phone',
      'price',
      'status',
    ];

    public function getStatusAttribute($value)
    {
        return strtoupper($value);
    }
}
