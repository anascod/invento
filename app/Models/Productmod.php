<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productmod extends Model
{
     use HasFactory;
        protected $table = "product";
    protected $fillable  = [
      'proname',
        'proquan' ,
        'prounite' ,
        'proprice' ,
        'supplyname' ,
    ];
protected $attributes   = [
        'proquan' => '0',
        'prounite' => '0',
        'proprice' => '0',
        'supplyname' => '0',
    ];
}
