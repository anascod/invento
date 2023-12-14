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
  Schema::create('sell_pro', function (Blueprint $table) {

         $table->id();
       $table->string('invono');
       $table->string('proname');
       $table->integer('proquan');
       $table->integer('total');
       $table->string('prounite');
       $table->string('custname');
       $table->timestamps();      
   });
       }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
     Schema::dropIfExists('sell_pro');
    }
};
