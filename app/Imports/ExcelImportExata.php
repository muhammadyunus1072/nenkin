<?php

namespace App\Imports;

use App\Repositories\Exata\ExataRepository;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class ExcelImportExata implements ToCollection
{
    public function collection(Collection $rows)
    {
        $rows = $rows->skip(1);

        foreach ($rows as $row) {
            $no = $row[0];
            $tgl_input = $row[1];
            $tgl_pulang = $row[2];
            $pipeline = $row[3];
            $nama_lengkap = $row[4];
            $gender = $row[5];
            $pendidikan = $row[6];
            $level_bahasa = $row[7];
            $sensei = $row[8];
            $dokumen = $row[9];
            $penerjemah = $row[10];
            $bidang_kerja_jepang = $row[11];
            $bidang_kerja_pilihan = $row[12];
            $estimasi_gaji = $row[13];
            $domisili = $row[14];
            $penempatan_kerja = $row[15];
            $tgl_siap_kerja = $row[16];
            $nama_tiktok = $row[17];
            $nama_instagram = $row[18];
            $no_telp_indonesia = $row[19];
            $no_telp_jepang = $row[20];
            $email = $row[21];
            $pic_sales = $row[22];
            $nama_lpk = $row[23];
            $keterangan = $row[24];

            $estimasi_gaji = explode('-', preg_replace('/[^0-9\-]/', '', $estimasi_gaji));
            $estimasi_gaji_bottom = $estimasi_gaji[0];
            $estimasi_gaji_top = isset($estimasi_gaji[1]) ? $estimasi_gaji[1] : null;
            $exata = ExataRepository::create([
                'No' => strtoupper($no),
                'TglInput' => strtoupper(preg_replace('/\s+/u', '', trim($tgl_input))) ? strtoupper(preg_replace('/\s+/u', '', trim($tgl_input))) : null,
                'TanggalPulang' => strtoupper(preg_replace('/\s+/u', '', trim($tgl_pulang))) ? strtoupper(preg_replace('/\s+/u', '', trim($tgl_pulang))) : null,
                'pipeline' => strtoupper($pipeline),
                'NamaLengkap' => strtoupper($nama_lengkap),
                'Gender' => strtoupper(preg_replace('/\s+/u', '', trim($gender))) ? strtoupper(preg_replace('/\s+/u', '', trim($gender))) : null,
                'Pendidikan' => strtoupper($pendidikan),
                'LevelBahasa' => strtoupper($level_bahasa),
                'Sensei' => strtoupper(preg_replace('/\s+/u', '', trim($sensei))) ? strtoupper(preg_replace('/\s+/u', '', trim($sensei))) : null,
                'Dokumen' => strtoupper(preg_replace('/\s+/u', '', trim($dokumen))) ? strtoupper(preg_replace('/\s+/u', '', trim($dokumen))) : null,
                'Penerjemah' => strtoupper(preg_replace('/\s+/u', '', trim($penerjemah))) ? strtoupper(preg_replace('/\s+/u', '', trim($penerjemah))) : null,
                'BidangKerjadiJepang' => strtoupper($bidang_kerja_jepang),
                'BidangKerjaPilihan' => strtoupper($bidang_kerja_pilihan),
                'EstimasiGaji' => strtoupper($estimasi_gaji_bottom),
                'EstimasiGajiTop' => strtoupper($estimasi_gaji_top),
                'Domisili' => strtoupper($domisili),
                'Penempatankerja' => strtoupper($penempatan_kerja),
                'tglSiapkerja' => strtoupper(preg_replace('/\s+/u', '', trim($tgl_siap_kerja))) ? strtoupper(preg_replace('/\s+/u', '', trim($tgl_siap_kerja))) : null,
                'NamaTikTok' => strtoupper($nama_tiktok),
                'NamaInstagram' => strtoupper($nama_instagram),
                'NoTelpIndonesia' => strtoupper($no_telp_indonesia),
                'NoTelpJepang' => strtoupper($no_telp_jepang),
                'email' => strtoupper($email),
                'PICSales' => strtoupper($pic_sales),
                'NamaLPK' => strtoupper($nama_lpk),
                'Keterangan' => strtoupper($keterangan),

                'available' => 'YA',
            ]);
        }
    }
}
