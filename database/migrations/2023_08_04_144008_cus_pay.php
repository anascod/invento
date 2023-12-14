<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
  Schema::create('cus_pay', function (Blueprint $table) {

         $table->id();
       $table->string('cusname');
       $table->integer('totamount');
       $table->integer('reminam');
       $table->string('invono');
       $table->integer('firstpay');
      $table->date('created_at');
       $table->date('updated_at');
          });
       }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
             Schema::dropIfExists('cus_pay');
    }
};
