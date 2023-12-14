<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payhes;
class pay_supply extends Model
{
    use HasFactory;
             protected $table = "pay_supply";
        protected $fillable = [
     'supplyname', 'totalamount','remaining','payid'];



 }
