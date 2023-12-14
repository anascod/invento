<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sellhes extends Model
{
    use HasFactory;
        protected $table = "sellhes";
        protected $fillable = ['invono','proname','proquan','total','prounite','custname'];

}
