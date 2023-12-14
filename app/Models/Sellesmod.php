<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sellesmod extends Model
{
 use HasFactory;
        protected $table = "selles";
        protected $fillable = [
      'sellesname','sellesquan','sellesprice','sellesunit','sellesprise','sellescus'];
}
