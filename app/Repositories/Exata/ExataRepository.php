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
        $nama_lengkap,
        $no_whatsapp,
        $estimasi_gaji,
        $domisili,
        $penempatan_kerja,
        $nama_lpk,
        $instagram,
        $tiktok,
        $keterangan,
        $date_type,
        $start_date,
        $end_date,
        $pipeline,
        $gender,
        $pendidikan,
        $level_bahasa,
        $job,
        $bidang_kerja_japan,
        $pilihan_kerja_indonesia,
        $pic_sales,
        $jenis_visa,
    ) {
        if ($date_type) {

            // dd([
            //     $nama_lengkap,
            //     $no_whatsapp,
            //     $estimasi_gaji,
            //     $domisili,
            //     $penempatan_kerja,
            //     $nama_lpk,
            //     $instagram,
            //     $tiktok,
            //     $keterangan,
            //     $date_type,
            //     $start_date,
            //     $end_date,
            //     $pipeline,
            //     $gender,
            //     $pendidikan,
            //     $level_bahasa,
            //     $job,
            //     $bidang_kerja_japan,
            //     $pilihan_kerja_indonesia,
            //     $pic_sales
            // ]);
        }
        return Exata::when($nama_lengkap, function ($query) use ($nama_lengkap) {
            $query->where('NamaLengkap', 'like', '%' . $nama_lengkap . '%');
        })
            ->when($no_whatsapp, function ($query) use ($no_whatsapp) {
                $query->where(function ($q) use ($no_whatsapp) {
                    $q->where('NoTelpIndonesia', 'like', '%' . $no_whatsapp . '%')
                        ->orWhere('NoTelpJepang', 'like', '%' . $no_whatsapp . '%');
                });
            })
            ->when($estimasi_gaji, function ($query) use ($estimasi_gaji) {
                $query->where('EstimasiGaji', '<=', $estimasi_gaji)
                    ->where(function ($q) use ($estimasi_gaji) {
                        $q->whereNull('EstimasiGajiTop')
                            ->orWhere('EstimasiGajiTop', '>=', $estimasi_gaji);
                    });
            })
            ->when($domisili, function ($query) use ($domisili) {
                $query->where('Domisili', 'like', '%' . $domisili . '%');
            })
            ->when($penempatan_kerja, function ($query) use ($penempatan_kerja) {
                $query->where('Penempatankerja', 'like', '%' . $penempatan_kerja . '%');
            })
            ->when($nama_lpk, function ($query) use ($nama_lpk) {
                $query->where('NamaLPK', 'like', '%' . $nama_lpk . '%');
            })
            ->when($instagram, function ($query) use ($instagram) {
                $query->where('NamaInstagram', 'like', '%' . $instagram . '%');
            })
            ->when($tiktok, function ($query) use ($tiktok) {
                $query->where('NamaTikTok', 'like', '%' . $tiktok . '%');
            })
            ->when($keterangan, function ($query) use ($keterangan) {
                $query->where('Keterangan', 'like', '%' . $keterangan . '%');
            })
            ->when(($start_date && $end_date) && $date_type == 'Tanggal Input', function ($query) use ($start_date, $end_date) {
                $query->whereBetween('TglInput', [$start_date, $end_date]);
            })
            ->when(($start_date && $end_date) && $date_type == 'Tanggal Pulang', function ($query) use ($start_date, $end_date) {
                $query->whereBetween('TanggalPulang', [$start_date, $end_date]);
            })
            ->when(($start_date && $end_date) && $date_type == 'Tanggal Siap Kerja', function ($query) use ($start_date, $end_date) {
                $query->whereBetween('tglSiapkerja', [$start_date, $end_date]);
            })
            ->when($pipeline, function ($query) use ($pipeline) {
                $query->where('pipeline', 'like', '%' . $pipeline . '%');
            })
            ->when($gender, function ($query) use ($gender) {
                $query->where('Gender', 'like', '%' .   $gender . '%');
            })
            ->when($pendidikan, function ($query) use ($pendidikan) {
                $query->where('Pendidikan', 'like', '%' .   $pendidikan . '%');
            })
            ->when($level_bahasa, function ($query) use ($level_bahasa) {
                $query->where('LevelBahasa', 'like', '%' .   $level_bahasa . '%');
            })
            ->when($job == 'Sensei', function ($query) {
                $query->where('Sensei', 'Ya');
            })
            ->when($job == 'Staff Dokumen', function ($query) {
                $query->where('Dokumen', 'Ya');
            })
            ->when($job == 'Penerjemah', function ($query) {
                $query->where('Penerjemah', 'Ya');
            })
            ->when($bidang_kerja_japan, function ($query) use ($bidang_kerja_japan) {
                $query->where('BidangKerjadiJepang', 'like', '%' . $bidang_kerja_japan . '%');
            })
            ->when($pilihan_kerja_indonesia, function ($query) use ($pilihan_kerja_indonesia) {
                $query->where('BidangKerjaPilihan', 'like', '%' .   $pilihan_kerja_indonesia . '%');
            })
            ->when($pic_sales, function ($query) use ($pic_sales) {
                $query->where('PICSales', 'like', '%' .  $pic_sales . '%');
            })
            ->when($jenis_visa, function ($query) use ($jenis_visa) {
                $query->where('JenisVisa', 'like', '%' .  $jenis_visa . '%');
            });
    }
}
