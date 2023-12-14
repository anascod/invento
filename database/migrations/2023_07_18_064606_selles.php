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
Schema::create('selles', function (Blueprint $table) {
       $table->id();
       $table->string('sellname');
       $table->string('sellquan');
       $table->string('sellunite');
       $table->string('sellprice');
       $table->string('cusname');
       $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
                Schema::dropIfExists('selles');
    }
};
