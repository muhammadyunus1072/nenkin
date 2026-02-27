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
        Schema::create('nenkins', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_nenkins', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('nenkins');
        Schema::dropIfExists('_history_nenkins');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
        } else {
        }

        $table->string('image')->comment('Nenkin Image');
        $table->date('date')->nullable()->comment('Date');
        $table->double('payment_top')->nullable()->comment('Payment Top');
        $table->double('payment')->nullable()->comment('Payment Amount');
        $table->double('income')->nullable()->comment('Payment Income');
        $table->double('net')->nullable()->comment('Payment Net');
        $table->string('name')->nullable()->comment('Name');
        $table->text('address')->nullable()->comment('Address');
        $table->string('number')->nullable()->comment('Number');

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
