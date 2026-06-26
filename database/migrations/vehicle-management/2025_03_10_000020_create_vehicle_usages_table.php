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
        Schema::create('vehicle_usages', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_vehicle_usages', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicle_usages');
        Schema::dropIfExists('_history_vehicle_usages');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
        } else {
            $table->index('vehicle_id', 'vehicle_usages_vehicle_id_idx');
            $table->index('user_id', 'vehicle_usages_user_id_idx');
        }

        $table->unsignedBigInteger('vehicle_id')->comment('ID Vehicle');

        // START
        $table->boolean('is_started')->default(true)->comment('Vehicle Usage Is Started');

        $table->unsignedBigInteger('user_id')->comment('ID User');
        $table->string('user_name')->comment('Vehicle Usage UserName');

        $table->double('start_odometer', 10, 2)->comment('Vehicle Usage Start Odometer (Km)');
        $table->double('start_fuel', 10, 2)->nullable()->comment('Vehicle Usage Start Fuel (Km)');
        $table->double('start_etoll_balance', 10, 2)->nullable()->comment('Vehicle Usage Start E-Toll Balance');

        $table->enum('start_tire_condition', ['baik', 'cukup', 'perlu_diperiksa'])->nullable()->comment('Vehicle Usage Start Tire Condition');
        $table->enum('start_light_condition', ['semua_menyala', 'ada_yang_mati'])->nullable()->comment('Vehicle Usage Start Light Condition');
        $table->enum('start_exterior_condition', ['bersih', 'tidak_terlalu_kotor', 'kotor'])->nullable()->comment('Vehicle Usage Start Exterior Condition');
        $table->enum('start_interior_condition', ['bersih', 'tidak_terlalu_kotor', 'kotor'])->nullable()->comment('Vehicle Usage Start Interior Condition');

        // END
        $table->boolean('is_done')->default(false)->comment('Vehicle Usage Is Done');

        $table->double('end_odometer', 10, 2)->nullable()->comment('Vehicle Usage End Odometer (Km)');
        $table->double('end_fuel', 10, 2)->nullable()->comment('Vehicle Usage End Fuel (Km)');
        $table->double('end_etoll_balance', 10, 2)->nullable()->comment('Vehicle Usage End EToll Balance');

        $table->enum('end_tire_condition', ['baik', 'cukup', 'perlu_diperiksa'])->nullable()->comment('Vehicle Usage Start Tire Condition');
        $table->enum('end_light_condition', ['semua_menyala', 'ada yang mati'])->nullable()->comment('Vehicle Usage Start Light Condition');
        $table->enum('end_exterior_condition', ['bersih', 'tidak_terlalu_kotor', 'kotor'])->nullable()->comment('Vehicle Usage Start Exterior Condition');
        $table->enum('end_interior_condition', ['bersih', 'tidak_terlalu_kotor', 'kotor'])->nullable()->comment('Vehicle Usage Start Interior Condition');

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
