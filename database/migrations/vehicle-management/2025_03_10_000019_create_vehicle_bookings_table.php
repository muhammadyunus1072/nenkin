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
        Schema::create('vehicle_bookings', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_vehicle_bookings', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicle_bookings');
        Schema::dropIfExists('_history_vehicle_bookings');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
        } else {
            $table->index('vehicle_id', 'vehicle_bookings_vehicle_id_idx');
            $table->index('user_id', 'vehicle_bookings_user_id_idx');
        }

        $table->unsignedBigInteger('vehicle_id')->comment('ID Vehicle');

        $table->unsignedBigInteger('user_id')->comment('ID User');
        $table->string('user_name')->comment('Vehicle Booking UserName');

        $table->string('purpose')->nullable()->comment('Vehicle Booking Purpose'); // keperluan
        $table->string('destination')->nullable()->comment('Vehicle Booking Destination'); // tujuan

        $table->timestamp('start_time')->comment('Vehicle Booking Start Time'); // mulai dipakai
        $table->timestamp('estimated_end_time')->nullable()->comment('Vehicle Booking Estimated End Time'); // estimasi pemakaian (menit)

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
