<?php

namespace App\Repositories\Exata;

use App\Models\Exata\Exata;
use App\Repositories\MasterDataRepository;

class ExataRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return Exata::class;
    }

    public static function datatable(
        $no,
        $tgl_input,
        $habis_kontrak,
        $kembali_ke_jepang,
        $nama_lengkap,
        $tgl_pulang,
        $pic,
        $nama_lpk,
        $lama_di_jepang,
        $referensi_kerja,
        $jenis_kelamin,
        $pendidikan,
        $tahun_terbit,
        $level_bahasa,
        $sensei,
        $dokumen,
        $penerjemah,
        $bidang_kerja_di_jepang,
        $bidang_kerja_pilihan,
        $senmongkyu,
        $bidang_senmongkyu,
        $jenis_visa,
        $nama_tiktok,
        $nama_instagram,
        $no_telp_indonesia,
        $no_telp_jepang,
        $email,
        $provinsi,
        $kota,
        $available,
    ) {
        return Exata::when($no, function ($query) use ($no) {
            $query->where('no', 'like', '%' . $no . '%');
        })
            ->when($tgl_input, function ($query) use ($tgl_input) {
                $query->where('tgl_input', 'like', '%' . $tgl_input . '%');
            })
            ->when($habis_kontrak, function ($query) use ($habis_kontrak) {
                $query->where('habis_kontrak', 'like', '%' . $habis_kontrak . '%');
            })
            ->when($kembali_ke_jepang, function ($query) use ($kembali_ke_jepang) {
                $query->where('kembali_ke_jepang', 'like', '%' . $kembali_ke_jepang . '%');
            })
            ->when($nama_lengkap, function ($query) use ($nama_lengkap) {
                $query->where('nama_lengkap', 'like', '%' . $nama_lengkap . '%');
            })
            ->when($tgl_pulang, function ($query) use ($tgl_pulang) {
                $query->where('tgl_pulang', 'like', '%' . $tgl_pulang . '%');
            })
            ->when($pic, function ($query) use ($pic) {
                $query->where('pic', 'like', '%' . $pic . '%');
            })
            ->when($nama_lpk, function ($query) use ($nama_lpk) {
                $query->where('nama_lpk', 'like', '%' . $nama_lpk . '%');
            })
            ->when($lama_di_jepang, function ($query) use ($lama_di_jepang) {
                $query->where('lama_di_jepang', 'like', '%' . $lama_di_jepang . '%');
            })
            ->when($referensi_kerja, function ($query) use ($referensi_kerja) {
                $query->where('referensi_kerja', 'like', '%' . $referensi_kerja . '%');
            })
            ->when($jenis_kelamin, function ($query) use ($jenis_kelamin) {
                $query->where('jenis_kelamin', 'like', '%' . $jenis_kelamin . '%');
            })
            ->when($pendidikan, function ($query) use ($pendidikan) {
                $query->where('pendidikan', 'like', '%' . $pendidikan . '%');
            })
            ->when($tahun_terbit, function ($query) use ($tahun_terbit) {
                $query->where('tahun_terbit', 'like', '%' . $tahun_terbit . '%');
            })
            ->when($level_bahasa, function ($query) use ($level_bahasa) {
                $query->where('level_bahasa', 'like', '%' . $level_bahasa . '%');
            })
            ->when($sensei, function ($query) use ($sensei) {
                $query->where('sensei', 'like', '%' . $sensei . '%');
            })
            ->when($dokumen, function ($query) use ($dokumen) {
                $query->where('dokumen', 'like', '%' . $dokumen . '%');
            })
            ->when($penerjemah, function ($query) use ($penerjemah) {
                $query->where('penerjemah', 'like', '%' . $penerjemah . '%');
            })
            ->when($bidang_kerja_di_jepang, function ($query) use ($bidang_kerja_di_jepang) {
                $query->where('bidang_kerja_di_jepang', 'like', '%' . $bidang_kerja_di_jepang . '%');
            })
            ->when($bidang_kerja_pilihan, function ($query) use ($bidang_kerja_pilihan) {
                $query->where('bidang_kerja_pilihan', 'like', '%' . $bidang_kerja_pilihan . '%');
            })
            ->when($senmongkyu, function ($query) use ($senmongkyu) {
                $query->where('senmongkyu', 'like', '%' . $senmongkyu . '%');
            })
            ->when($bidang_senmongkyu, function ($query) use ($bidang_senmongkyu) {
                $query->where('bidang_senmongkyu', 'like', '%' . $bidang_senmongkyu . '%');
            })
            ->when($jenis_visa, function ($query) use ($jenis_visa) {
                $query->where('jenis_visa', 'like', '%' . $jenis_visa . '%');
            })
            ->when($nama_tiktok, function ($query) use ($nama_tiktok) {
                $query->where('nama_tiktok', 'like', '%' . $nama_tiktok . '%');
            })
            ->when($nama_instagram, function ($query) use ($nama_instagram) {
                $query->where('nama_instagram', 'like', '%' . $nama_instagram . '%');
            })
            ->when($no_telp_indonesia, function ($query) use ($no_telp_indonesia) {
                $query->where('no_telp_indonesia', 'like', '%' . $no_telp_indonesia . '%');
            })
            ->when($no_telp_jepang, function ($query) use ($no_telp_jepang) {
                $query->where('no_telp_jepang', 'like', '%' . $no_telp_jepang . '%');
            })
            ->when($email, function ($query) use ($email) {
                $query->where('email', 'like', '%' . $email . '%');
            })
            ->when($provinsi, function ($query) use ($provinsi) {
                $query->where('provinsi', 'like', '%' . $provinsi . '%');
            })
            ->when($kota, function ($query) use ($kota) {
                $query->where('kota', 'like', '%' . $kota . '%');
            })
            ->when($available !== null, function ($query) use ($available) {
                $query->where('available', $available == 'y' ? true : false);
            });
    }
}
