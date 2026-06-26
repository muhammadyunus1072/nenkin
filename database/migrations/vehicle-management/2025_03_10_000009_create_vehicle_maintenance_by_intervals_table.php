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
        Schema::create('vehicle_maintenance_by_intervals', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_vehicle_maintenance_by_intervals', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicle_maintenance_by_intervals');
        Schema::dropIfExists('_history_vehicle_maintenance_by_intervals');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
        } else {
            $table->index('vehicle_id', 'vehicle_maintenance_by_intervals_vehicle_id_idx');
        }

        $table->unsignedBigInteger('vehicle_id')->comment('ID Vehicle');
        $table->string('name')->comment('Vehicle Maintenance Name');
        $table->string('message')->comment('Vehicle Maintenance Message');
        $table->double('notif_interval', 10, 2)->comment('Vehicle Maintenance notif Interval (Km)');
        $table->double('current_interval', 10, 2)->default(0)->comment('Vehicle Maintenance Current Interval (Km)');

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
