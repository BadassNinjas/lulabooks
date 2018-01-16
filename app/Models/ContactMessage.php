<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{

    public $table = 'contact_message';

    // See laravel migration modifiers:
    // https://laravel.com/docs/5.3/migrations#column-modifiers

    protected $fillable = [
      'firstname',
      'lastname',
      'message',
      'email',
      'phone',
    ];
}
