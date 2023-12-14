<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\pay_supply;

class Payhes extends Model
{
    use HasFactory;

    protected $table = "payhes";
        protected $fillable = [ 'amount', 'payment','remain','pay_supply_id'];

}
