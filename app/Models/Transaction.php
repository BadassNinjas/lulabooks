<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    public $table = 'transaction';

    protected $fillable = [
      'payment_status',
      'status',
      'shipping',
    ];

    protected $with = [
      'user'
    ];

    public function user()
    {
        return $this->hasOne('\App\Models\User', 'id', 'user_id');
    }

    public function getItemsAttribute($value)
    {
        return json_decode($value);
    }
}
