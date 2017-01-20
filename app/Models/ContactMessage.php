<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use BadassNinjas\Migrator\Traits\MigratorTrait;

class ContactMessage extends Model
{
    use MigratorTrait;

    public $table = 'contact_message';

    protected $schema = [
      'firstname' => [
        'type' => 'string',
        'length' => 32,
        'modifiers' => [
          'nullable'
        ]
      ],
      'lastname' => [
        'type' => 'string',
        'length' => 32,
        'modifiers' => [
          'nullable'
        ]
      ],
      'email' => [
        'type' => 'string',
        'length' => 32,
        'modifiers' => [
          'nullable'
        ]
      ],
      'phone' => [
        'type' => 'string',
        'length' => 32,
        'modifiers' => [
          'nullable'
        ]
      ],
      'message' => [
        'type' => 'string',
        'length' => 32,
        'modifiers' => [
          'nullable'
        ]
      ]
    ];

    protected $fillable = [
      'firstname',
      'lastname',
      'message',
      'email',
      'phone',
    ];
}
