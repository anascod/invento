<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cus_phes extends Model
{
    use HasFactory;

        protected $table = "cus_phes";
        protected $fillable = [
      'invono','totamount','reminam','payment'];
  }
