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

            // Data Baru
            $table->text('KodeUnik')->nullable();
            $table->date('TanggalLahir')->nullable();
            $table->text('Gender')->nullable();
            $table->text('Pendidikan')->nullable();
            $table->text('LevelBahasa')->nullable();
            $table->text('LamaDiJepang')->nullable();
            $table->double('EstimasiGaji', 10, 2)->nullable();
            $table->double('EstimasiGajiTop', 10, 2)->nullable();
            $table->text('Domisili')->nullable();
            $table->date('TglSiapkerja')->nullable();
            $table->text('BidangKerjadiJepang')->nullable();
            $table->text('BidangKerjaPilihan')->nullable();
            $table->text('Sensei')->nullable();
            $table->text('Dokumen')->nullable();
            $table->text('Penerjemah')->nullable();

            $table->text('SkillKomputer')->nullable();
            $table->text('SoftSkill')->nullable();
            $table->text('Keterangan')->nullable();
        });
        Schema::table('_history_exata_preview_candidates', function (Blueprint $table) {

            // Data Baru
            $table->text('KodeUnik')->nullable();
            $table->date('TanggalLahir')->nullable();
            $table->text('Gender')->nullable();
            $table->text('Pendidikan')->nullable();
            $table->text('LevelBahasa')->nullable();
            $table->text('LamaDiJepang')->nullable();
            $table->double('EstimasiGaji', 10, 2)->nullable();
            $table->double('EstimasiGajiTop', 10, 2)->nullable();
            $table->text('Domisili')->nullable();
            $table->date('TglSiapkerja')->nullable();
            $table->text('BidangKerjadiJepang')->nullable();
            $table->text('BidangKerjaPilihan')->nullable();
            $table->text('Sensei')->nullable();
            $table->text('Dokumen')->nullable();
            $table->text('Penerjemah')->nullable();

            $table->text('SkillKomputer')->nullable();
            $table->text('SoftSkill')->nullable();
            $table->text('Keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exata_preview_candidates', function (Blueprint $table) {

            // Data Baru
            $table->dropColumn('KodeUnik');
            $table->dropColumn('TanggalLahir');
            $table->dropColumn('Gender');
            $table->dropColumn('Pendidikan');
            $table->dropColumn('LevelBahasa');
            $table->dropColumn('LamaDiJepang');
            $table->dropColumn('EstimasiGaji');
            $table->dropColumn('EstimasiGajiTop');
            $table->dropColumn('Domisili');
            $table->dropColumn('TglSiapkerja');
            $table->dropColumn('BidangKerjadiJepang');
            $table->dropColumn('BidangKerjaPilihan');
            $table->dropColumn('Sensei');
            $table->dropColumn('Dokumen');
            $table->dropColumn('Penerjemah');

            $table->dropColumn('SkillKomputer');
            $table->dropColumn('SoftSkill');
            $table->dropColumn('Keterangan');
        });
        Schema::table('_history_exata_preview_candidates', function (Blueprint $table) {

            // Data Baru
            $table->dropColumn('KodeUnik');
            $table->dropColumn('TanggalLahir');
            $table->dropColumn('Gender');
            $table->dropColumn('Pendidikan');
            $table->dropColumn('LevelBahasa');
            $table->dropColumn('LamaDiJepang');
            $table->dropColumn('EstimasiGaji');
            $table->dropColumn('EstimasiGajiTop');
            $table->dropColumn('Domisili');
            $table->dropColumn('TglSiapkerja');
            $table->dropColumn('BidangKerjadiJepang');
            $table->dropColumn('BidangKerjaPilihan');
            $table->dropColumn('Sensei');
            $table->dropColumn('Dokumen');
            $table->dropColumn('Penerjemah');

            $table->dropColumn('SkillKomputer');
            $table->dropColumn('SoftSkill');
            $table->dropColumn('Keterangan');
        });
    }
};
