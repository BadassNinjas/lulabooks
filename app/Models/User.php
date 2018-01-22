<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $table = 'user';

    const ROLE_CUSTOMER = 'customer';
    const ROLE_ADMIN = 'admin';
    const ROLE_SUPERADMIN = 'superadmin';

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function billing_detail()
    {
        return $this->hasOne('App\Models\UserBillingDetail', 'user_id', 'id');
    }
}
