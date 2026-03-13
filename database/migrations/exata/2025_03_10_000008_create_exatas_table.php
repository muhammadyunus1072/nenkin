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
        Schema::create('exatas', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_exatas', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('exatas');
        Schema::dropIfExists('_history_exatas');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
        } else {
        }
        // Data Baru
        $table->text('Ref')->nullable();
        $table->date('TglInput')->nullable();
        $table->text('pipeline')->nullable();
        $table->text('NamaLengkap')->nullable();
        $table->date('TanggalLahir')->nullable();
        $table->text('Gender')->nullable();
        $table->text('Pendidikan')->nullable();
        $table->text('LevelBahasa')->nullable();
        $table->text('TahunTerbit')->nullable();
        $table->text('LamaDiJepang')->nullable();
        $table->date('TanggalPulang')->nullable();
        $table->text('Sensei')->nullable();
        $table->text('Dokumen')->nullable();
        $table->text('Penerjemah')->nullable();
        $table->double('EstimasiGaji', 10, 2)->nullable();
        $table->double('EstimasiGajiTop', 10, 2)->nullable();
        $table->text('Domisili')->nullable();
        $table->text('Penempatankerja')->nullable();
        $table->date('TglSiapkerja')->nullable();
        $table->text('BidangKerjadiJepang')->nullable();
        $table->text('BidangKerjaPilihan')->nullable();
        $table->text('Senmongkyu')->nullable();
        $table->text('BidangSenmongkyu')->nullable();
        $table->text('JenisVisa')->nullable();
        $table->text('Provinsi')->nullable();
        $table->text('Kota')->nullable();
        $table->text('NamaTikTok')->nullable();
        $table->text('NamaInstagram')->nullable();
        $table->text('NoTelpIndonesia')->nullable();
        $table->text('NoTelpJepang')->nullable();
        $table->text('Email')->nullable();
        $table->text('PICSales')->nullable();
        $table->text('NamaLPK')->nullable();
        $table->text('Keterangan')->nullable();
        $table->string('Available')->nullable()->comment('Exata available');

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
