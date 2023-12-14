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
         Schema::create('cus_phes', function (Blueprint $table) {

         $table->id();
       $table->string('invono');
       $table->integer('totamount');
       $table->integer('payment');
       $table->integer('reminam');
       $table->date('created_at');
       $table->date('updated_at');
          });
       }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
             Schema::dropIfExists('cus_phes');
    }
};
