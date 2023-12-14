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
Schema::create('purchase', function (Blueprint $table) {
       $table->id();
       $table->integer('purnum');
       $table->string('itemname');
       $table->integer('purquan');
       $table->string('purunit');
       $table->string('supply');
       $table->string('paytype');
       $table->integer('amount');
       $table->integer('payprice');
       $table->integer('selprice');
       $table->timestamps();
        });

        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
     Schema::dropIfExists('purchase');
    }
};
