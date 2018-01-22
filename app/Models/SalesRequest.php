<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesRequest extends Model
{
    public $table = 'sales_request';

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
