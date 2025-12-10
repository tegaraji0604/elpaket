<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('shipments', function (Blueprint $table) {
        $table->id();
        $table->string('tracking_number')->unique();
        $table->string('sender_name');
        $table->string('sender_address');
        $table->string('receiver_name');
        $table->string('receiver_address');
        $table->string('weight');
        $table->string('description');
        $table->string('status')->default('Diproses');
        $table->timestamp('completed_at')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
