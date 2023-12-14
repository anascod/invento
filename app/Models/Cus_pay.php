<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cus_pay extends Model
{
    use HasFactory;

        protected $table = "cus_pay";
        protected $fillable = [
      'cusname','totamount','reminam','invono','firstpay'];
}
