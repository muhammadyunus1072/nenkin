<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('history_file_previews', function (Blueprint $table) {
            $this->scheme($table);
        });

        Schema::create('_history_history_file_previews', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_file_previews');
        Schema::dropIfExists('_history_history_file_previews');
    }

    private function scheme(Blueprint $table, $isHistory = false)
    {
        $table->id();
        if ($isHistory) {
            $table->bigInteger('obj_id')->unsigned();
        } else {
        }

        $table->string('original_name');       // KK_andi.jpg
        $table->text('stored_name');         // uuid filename
        $table->text('description')->nullable()->default(null);
        $table->text('path');                // storage path

        $table->bigInteger("created_by")->unsigned();
        $table->bigInteger("updated_by")->unsigned();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
