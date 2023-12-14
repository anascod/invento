<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplymod extends Model
{
    use HasFactory;
        protected $table = "supply";
        protected $fillable = [
      'supplu_name','supplu_addr','supplu_email','supplu_phone','amount'];

protected $attributes   = [
        'amount' => '0',
    ];

}
