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
        Schema::table('vehicle_maintenance_by_intervals', function (Blueprint $table) {
            $table->boolean('is_show')->default(false)->comment('Vehicle Maintenance By Interval Is Show');
        });
        Schema::table('_history_vehicle_maintenance_by_intervals', function (Blueprint $table) {
            $table->boolean('is_show')->default(false)->comment('Vehicle Maintenance By Interval Is Show');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_maintenance_by_intervals', function (Blueprint $table) {
            $table->dropColumn('is_show');
        });
        Schema::table('_history_vehicle_maintenance_by_intervals', function (Blueprint $table) {
            $table->dropColumn('is_show');
        });
    }
};
