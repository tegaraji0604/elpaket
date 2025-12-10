<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('shipments', function (Blueprint $table) {
            // tambahkan completed_at jika belum ada
            if (!Schema::hasColumn('shipments', 'completed_at')) {
                $table->dateTime('completed_at')->nullable()->after('status');
            }
        });
    }

    public function down()
    {
        Schema::table('shipments', function (Blueprint $table) {
            if (Schema::hasColumn('shipments', 'completed_at')) {
                $table->dropColumn('completed_at');
            }
        });
    }
};
