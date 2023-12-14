<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customermod extends Model
{
    use HasFactory;
        protected $table = "customer";
        protected $fillable = [
      'cusname','cusemail','cusadd','cusphone'];
}
