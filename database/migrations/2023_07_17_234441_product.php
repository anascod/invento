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
 Schema::create('product', function (Blueprint $table) {
       $table->increments('id');
       $table->string('proname')->nullable()->default(NULL);
       $table->string('proquan')->nullable()->default(NULL);
       $table->string('prounite')->nullable()->default(NULL);
       $table->string('proprice')->nullable()->default(NULL);
       $table->string('supplyname')->nullable()->default(NULL);
       $table->string('prosupplyprice')->nullable()->default(NULL);
       $table->timestamps();

    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
                Schema::dropIfExists('product');

    }
};
