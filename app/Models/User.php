<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
//
use BadassNinjas\Migrator\Traits\MigratorTrait;

class User extends Authenticatable
{
    use MigratorTrait;

    public $table = 'user';

    const ROLE_CUSTOMER = 'customer';
    const ROLE_ADMIN = 'admin';
    const ROLE_SUPERADMIN = 'superadmin';

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $hardSchema = [
        'firstname' => [
          'type' => 'string',
          'length' => 64,
          'modifiers' => [
            'comment' => 'Customers firstname'
          ]
        ],
        'lastname' => [
          'type' => 'string',
          'length' => 64,
          'modifiers' => [
            'comment' => 'Customers lastname'
          ]
        ],
        'email' => [
          'type' => 'string',
          'length' => 128,
          'modifiers' => [
            'nullable',
            'comment' => 'User email address and username'
          ]
        ],
        'password' => [
          'type' => 'string',
          'length' => 128,
          'modifiers' => [
            'comment' => 'User encrypted password'
          ]
        ],
        'remember_token' => [
          'type' => 'string',
          'length' => 128,
          'modifiers' => [
            'nullable',
            'comment' => 'User encrypted session token'
          ]
        ],
        'role' => [
          'type' => 'string',
          'length' => 128,
          'modifiers' => [
            'default' => 'customer',
            'comment' => 'User role'
          ]
        ],
    ];

    public function billing_detail()
    {
        return $this->hasOne('App\Models\UserBillingDetail', 'user_id', 'id');
    }
}
