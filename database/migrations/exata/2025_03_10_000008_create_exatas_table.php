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
        $table->text('No')->nullable();
        $table->date('TglInput')->nullable();
        $table->date('TanggalPulang')->nullable();
        $table->text('pipeline')->nullable();
        $table->text('NamaLengkap')->nullable();
        $table->text('Gender')->nullable();
        $table->text('Pendidikan')->nullable();
        $table->text('TahunTerbit')->nullable();
        $table->text('LevelBahasa')->nullable();
        $table->text('LamaDiJepang')->nullable();
        $table->text('Sensei')->nullable();
        $table->text('Dokumen')->nullable();
        $table->text('Penerjemah')->nullable();
        $table->text('BidangKerjadiJepang')->nullable();
        $table->text('BidangKerjaPilihan')->nullable();
        $table->text('EstimasiGaji')->nullable();
        $table->text('EstimasiGajiTop')->nullable();
        $table->text('Domisili')->nullable();
        $table->text('Penempatankerja')->nullable();
        $table->date('tglSiapkerja')->nullable();
        $table->text('Senmongkyu')->nullable();
        $table->text('BidangSenmongkyu')->nullable();
        $table->text('JenisVisa')->nullable();
        $table->text('Provinsi')->nullable();
        $table->text('Kota')->nullable();
        $table->text('NamaTikTok')->nullable();
        $table->text('NamaInstagram')->nullable();
        $table->text('NoTelpIndonesia')->nullable();
        $table->text('NoTelpJepang')->nullable();
        $table->text('email')->nullable();
        $table->text('PICSales')->nullable();
        $table->text('NamaLPK')->nullable();
        $table->text('Keterangan')->nullable();

        // No	
        // Tgl. Input	
        // Tanggal Pulang	
        // pipeline	
        // Nama Lengkap	
        // L / P	
        // Pendidikan	
        // Level Bahasa	
        // Sensei	
        // Dokumen	
        // Penerjemah	
        // Bidang Kerja di Jepang	
        // Bidang Kerja Pilihan	
        // Estimasi Gaji	
        // Domisili	
        // Penempatan kerja	
        // tgl Siap kerja	
        // Nama TikTok	
        // Nama Instagram	
        // No. Telp Indonesia	
        // No. Telp Jepang	
        // email	
        // PIC / Sales	
        // Nama LPK	
        // Keterangan

        // Data Lama
        // $table->string('no')->nullable()->comment('Exata no');
        // $table->date('tgl_input')->nullable()->comment('Exata tgl_input');
        // $table->string('habis_kontrak')->nullable()->comment('Exata habis_kontrak');
        // $table->date('kembali_ke_jepang')->nullable()->comment('Exata kembali_ke_jepang');
        // $table->string('nama_lengkap')->nullable()->comment('Exata nama_lengkap');
        // $table->date('tgl_pulang')->nullable()->comment('Exata tgl_pulang');
        // $table->string('pic')->nullable()->comment('Exata pic');
        // $table->string('nama_lpk')->nullable()->comment('Exata nama_lpk');
        // $table->string('lama_di_jepang')->nullable()->comment('Exata lama_di_jepang');
        // $table->string('referensi_kerja')->nullable()->comment('Exata referensi_kerja');
        // $table->string('jenis_kelamin')->nullable()->comment('Exata jenis_kelamin');
        // $table->string('pendidikan')->nullable()->comment('Exata pendidikan');
        // $table->string('tahun_terbit')->nullable()->comment('Exata tahun_terbit');
        // $table->string('level_bahasa')->nullable()->comment('Exata level_bahasa');
        // $table->string('sensei')->nullable()->comment('Exata sensei');
        // $table->string('dokumen')->nullable()->comment('Exata dokumen');
        // $table->string('penerjemah')->nullable()->comment('Exata penerjemah');
        // $table->string('bidang_kerja_di_jepang')->nullable()->comment('Exata bidang_kerja_di_jepang');
        // $table->string('bidang_kerja_pilihan')->nullable()->comment('Exata bidang_kerja_pilihan');
        // $table->string('senmongkyu')->nullable()->comment('Exata senmongkyu');
        // $table->string('bidang_senmongkyu')->nullable()->comment('Exata bidang_senmongkyu');
        // $table->string('jenis_visa')->nullable()->comment('Exata jenis_visa');
        // $table->string('nama_tiktok')->nullable()->comment('Exata nama_tiktok');
        // $table->string('nama_instagram')->nullable()->comment('Exata nama_instagram');
        // $table->string('no_telp_indonesia')->nullable()->comment('Exata no_telp_indonesia');
        // $table->string('no_telp_jepang')->nullable()->comment('Exata no_telp_jepang');
        // $table->string('email')->nullable()->comment('Exata email');
        // $table->string('provinsi')->nullable()->comment('Exata provinsi');
        // $table->string('kota')->nullable()->comment('Exata kota');

        $table->string('available')->nullable()->comment('Exata available');

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
