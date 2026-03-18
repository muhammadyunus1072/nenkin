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
        Schema::table('exatas', function (Blueprint $table) {

            $table->double('TinggiBadan', 10, 2)->nullable();
            $table->double('BeratBadan', 10, 2)->nullable();
            $table->text('SkillBahasaLain')->nullable();
            $table->text('SkillKomputer')->nullable();
            $table->text('PencapaianTertinggi')->nullable();
            $table->text('ValueSaatDiJepang')->nullable();
            $table->text('SoftSkill')->nullable();
            $table->text('SkillLainnya')->nullable();
            $table->text('PengalamanKerja')->nullable();
        });
        Schema::table('_history_exatas', function (Blueprint $table) {

            $table->double('TinggiBadan', 10, 2)->nullable();
            $table->double('BeratBadan', 10, 2)->nullable();
            $table->text('SkillBahasaLain')->nullable();
            $table->text('SkillKomputer')->nullable();
            $table->text('PencapaianTertinggi')->nullable();
            $table->text('ValueSaatDiJepang')->nullable();
            $table->text('SoftSkill')->nullable();
            $table->text('SkillLainnya')->nullable();
            $table->text('PengalamanKerja')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exatas', function (Blueprint $table) {

            $table->dropColumn('TinggiBadan');
            $table->dropColumn('BeratBadan');
            $table->dropColumn('SkillBahasaLain');
            $table->dropColumn('SkillKomputer');
            $table->dropColumn('PencapaianTertinggi');
            $table->dropColumn('ValueSaatDiJepang');
            $table->dropColumn('SoftSkill');
            $table->dropColumn('SkillLainnya');
            $table->dropColumn('PengalamanKerja');
        });
        Schema::table('_history_exatas', function (Blueprint $table) {

            $table->dropColumn('TinggiBadan');
            $table->dropColumn('BeratBadan');
            $table->dropColumn('SkillBahasaLain');
            $table->dropColumn('SkillKomputer');
            $table->dropColumn('PencapaianTertinggi');
            $table->dropColumn('ValueSaatDiJepang');
            $table->dropColumn('SoftSkill');
            $table->dropColumn('SkillLainnya');
            $table->dropColumn('PengalamanKerja');
        });
    }
};
