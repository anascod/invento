<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchasemod extends Model
{
 use HasFactory;
        protected $table = "purchase";
        protected $fillable = [
     'amount', 'purnum','itemname','purquan','purunit','supply','purunit','paytype','selprice','payprice'];

protected $attributes   = [
        'amount' => '0',
        ];
}
