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
        Schema::create('vehicles', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_vehicles', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('_history_vehicles');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
        } else {
            $table->index('name', 'vehicles_name_idx');
            $table->index('is_active', 'vehicles_is_active_idx');
        }

        $table->string('image')->comment('Vehicle Image');
        $table->string('name')->comment('Vehicle Name');
        $table->boolean('is_active')->default(true)->comment('Vehicle Status');
        $table->string('number_plate')->comment('Vehicle Number Plate');
        $table->double('max_range')->comment('Vehicle Max Range (Km)');
        $table->double('current_odometer', 10, 2)->comment('Vehicle Current Odometer (Km)');
        $table->double('current_fuel', 10, 2)->comment('Vehicle Current Fuel (Km)');
        $table->double('current_etoll_balance', 10, 2)->comment('Vehicle Current E-Toll Balance');

        $table->string('lat')->nullable()->comment('Vehicle Latitude');
        $table->string('lng')->nullable()->comment('Vehicle Longitude');

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
