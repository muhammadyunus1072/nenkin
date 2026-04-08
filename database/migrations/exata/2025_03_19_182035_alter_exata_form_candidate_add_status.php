<?php

use App\Models\Exata\ExataFormCandidate;
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
        Schema::table('exata_form_candidates', function (Blueprint $table) {
            $table->string('status')->default(ExataFormCandidate::STATUS_CREATED)->nullable();
            $table->unsignedBigInteger('exata_id')->nullable();
        });
        Schema::table('_history_exata_form_candidates', function (Blueprint $table) {
            $table->string('status')->default(ExataFormCandidate::STATUS_CREATED)->nullable();
            $table->unsignedBigInteger('exata_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exatas', function (Blueprint $table) {

            $table->dropColumn('status');
            $table->dropColumn('exata_id');
        });
        Schema::table('_history_exatas', function (Blueprint $table) {

            $table->dropColumn('status');
            $table->dropColumn('exata_id');
        });
    }
};
