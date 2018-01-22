<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    public $table = 'contact_message';

    protected $fillable = [
      'firstname',
      'lastname',
      'message',
      'email',
      'phone',
    ];
}
