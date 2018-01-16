<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//
use BadassNinjas\Migrator\Traits\MigratorTrait;

class UserBillingDetail extends Model
{
    use MigratorTrait;

    public $table = 'user_billing_detail';

    protected $hardSchema = [
        'user_id' => [
          'type' => 'string',
          'length' => 64,
          'modifiers' => [
            'comment' => 'User account pivotal - set as string incase parent is not using incremental ID'
          ]
        ],
        'firstname' => [
          'type' => 'string',
          'length' => 64,
          'modifiers' => [
            'comment' => 'Shipping recipient firstname'
          ]
        ],
        'lastname' => [
          'type' => 'string',
          'length' => 64,
          'modifiers' => [
            'comment' => 'Shipping recipient lastname'
          ]
        ],
        'company' => [
          'type' => 'string',
          'length' => 128,
          'modifiers' => [
            'nullable',
            'comment' => 'Shipping recipient company detail'
          ]
        ],
        'company_vat' => [
          'type' => 'string',
          'length' => 128,
          'modifiers' => [
            'nullable',
            'comment' => 'Shipping recipient company vat number'
          ]
        ],
        'email' => [
          'type' => 'string',
          'length' => 128,
          'modifiers' => [
            'comment' => 'Shipping recipient email address'
          ]
        ],
        'phone' => [
          'type' => 'string',
          'length' => 64,
          'modifiers' => [
            'comment' => 'Shipping recipient phone number'
          ]
        ],
        'country' => [
          'type' => 'string',
          'length' => 64,
          'modifiers' => [
            'comment' => 'Shipping recipient country name'
          ]
        ],
        'region' => [
          'type' => 'string',
          'length' => 64,
          'modifiers' => [
            'comment' => 'Shipping recipient region name'
          ]
        ],
        'city' => [
          'type' => 'string',
          'length' => 64,
          'modifiers' => [
            'comment' => 'Shipping recipient city name'
          ]
        ],
        'building' => [
          'type' => 'string',
          'length' => 192,
          'modifiers' => [
            'nullable',
            'comment' => 'Shipping recipient building detail'
          ]
        ],
        'street' => [
          'type' => 'string',
          'length' => 128,
          'modifiers' => [
            'comment' => 'Shipping recipient street address'
          ]
        ],
        'postcode' => [
          'type' => 'string',
          'length' => 32,
          'modifiers' => [
            'comment' => 'Shipping recipient postal code'
          ]
        ],
    ];
}
