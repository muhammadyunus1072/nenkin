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
        $estimasi_gaji_top,
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
        $job_sensei,
        $job_staff_dokumen,
        $job_penerjemah,
        $bidang_kerja_japan,
        $pilihan_kerja_indonesia,
        $pic_sales,
        $jenis_visa,
    ) {
        if ($job_sensei) {

            logger([
                $nama_lengkap,
                $no_whatsapp,
                $estimasi_gaji,
                $estimasi_gaji_top,
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
                $job_sensei,
                $job_staff_dokumen,
                $job_penerjemah,
                $bidang_kerja_japan,
                $pilihan_kerja_indonesia,
                $pic_sales,
                $jenis_visa,
            ]);
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
            ->when($estimasi_gaji, function ($query) use ($estimasi_gaji, $estimasi_gaji_top) {
                $query->where('EstimasiGaji', '>=', $estimasi_gaji)
                    ->where('EstimasiGaji', '<=', $estimasi_gaji_top ?? 0);
                // ->where(function ($q) use ($estimasi_gaji) {
                //     $q->whereNull('EstimasiGajiTop')
                //         ->orWhere('EstimasiGajiTop', '>=', $estimasi_gaji);
                // });
            })
            ->when($domisili, function ($query) use ($domisili) {
                $query->where(function ($q) use ($domisili) {
                    foreach ($domisili as $item) {
                        $q->orWhere('Domisili', 'like', '%' . $item . '%');
                    }
                });
            })
            ->when($penempatan_kerja, function ($query) use ($penempatan_kerja) {
                $query->where(function ($q) use ($penempatan_kerja) {
                    foreach ($penempatan_kerja as $item) {
                        $q->orWhere('Penempatankerja', 'like', '%' . $item . '%');
                    }
                });
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
                $query->whereBetween('TglSiapkerja', [$start_date, $end_date]);
            })
            ->when(!empty($pipeline), function ($query) use ($pipeline) {
                $query->whereIn('Pipeline', $pipeline);
            })
            ->when(!empty($gender), function ($query) use ($gender) {
                $query->whereIn('Gender', $gender);
            })
            ->when(!empty($pendidikan), function ($query) use ($pendidikan) {
                $query->whereIn('Pendidikan', $pendidikan);
            })
            ->when(!empty($level_bahasa), function ($query) use ($level_bahasa) {
                $query->whereIn('LevelBahasa', $level_bahasa);
            })
            ->when($job_sensei == 'YA', function ($query) {
                $query->where('Sensei', 'YA');
            })
            ->when($job_staff_dokumen == 'YA', function ($query) {
                $query->where('Dokumen', 'YA');
            })
            ->when($job_penerjemah == 'YA', function ($query) {
                $query->where('Penerjemah', 'YA');
            })
            ->when($bidang_kerja_japan, function ($query) use ($bidang_kerja_japan) {
                $query->where('BidangKerjadiJepang', 'like', '%' . $bidang_kerja_japan . '%');
            })
            ->when(!empty($pilihan_kerja_indonesia), function ($query) use ($pilihan_kerja_indonesia) {
                foreach ($pilihan_kerja_indonesia as $item) {
                    $query->where('BidangKerjaPilihan', 'like', '%' . $item . '%');
                }
            })
            ->when(!empty($pic_sales), function ($query) use ($pic_sales) {
                $query->whereIn('PICSales', $pic_sales);
            })
            ->when(!empty($jenis_visa), function ($query) use ($jenis_visa) {
                $query->whereIn('JenisVisa', $jenis_visa);
            });
    }
}
