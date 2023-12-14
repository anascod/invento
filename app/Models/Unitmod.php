<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unitmod extends Model
{
    use HasFactory;
        protected $table = "pro_unit";
        protected $fillable = ['unitname'];

}
