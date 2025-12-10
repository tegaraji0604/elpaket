<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shipment_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id')
                  ->constrained('shipments')
                  ->onDelete('cascade'); // foreign key cukup di sini
            $table->string('status');
            $table->timestamp('tanggal_status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipment_history');
    }
};
