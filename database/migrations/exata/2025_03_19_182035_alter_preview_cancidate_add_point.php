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
        Schema::table('exata_preview_candidates', function (Blueprint $table) {
            $table->text('poin_rekomendasi')->nullable();
        });
        Schema::table('_history_exata_preview_candidates', function (Blueprint $table) {
            $table->text('poin_rekomendasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exata_preview_candidates', function (Blueprint $table) {
            $table->dropColumn('poin_rekomendasi');
        });
        Schema::table('_history_exata_preview_candidates', function (Blueprint $table) {
            $table->dropColumn('poin_rekomendasi');
        });
    }
};
