<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell_pro extends Model
{
    use HasFactory;
       protected $table = "Sell_pro";
        protected $fillable = ['invono','proname','proquan','total','prounite','custname'];


}
