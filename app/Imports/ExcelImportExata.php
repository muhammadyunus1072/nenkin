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
            $habis_kontrak = $row[2];
            $kembali_ke_jepang = $row[3];
            $nama_lengkap = $row[4];
            $tgl_pulang = $row[5];
            $pic = $row[6];
            $nama_lpk = $row[7];
            $lama_di_jepang = $row[8];
            $referensi_kerja = $row[9];
            $jenis_kelamin = $row[10];
            $pendidikan = $row[11];
            $tahun_terbit = $row[12];
            $level_bahasa = $row[13];
            $sensei = $row[14];
            $dokumen = $row[15];
            $penerjemah = $row[16];
            $bidang_kerja_di_jepang = $row[17];
            $bidang_kerja_pilihan = $row[18];
            $senmongkyu = $row[19];
            $bidang_senmongkyu = $row[20];
            $jenis_visa = $row[21];
            $nama_tiktok = $row[22];
            $nama_instagram = $row[23];
            $no_telp_indonesia = $row[24];
            $no_telp_jepang = $row[25];
            $email = $row[26];
            $provinsi = $row[27];
            $kota = $row[28];

            $exata = ExataRepository::create([
                'no' => strtoupper($no),
                'tgl_input' => strtoupper($tgl_input),
                'habis_kontrak' => strtoupper($habis_kontrak),
                'kembali_ke_jepang' => strtoupper(preg_replace('/\s+/u', '', trim($kembali_ke_jepang))) ? strtoupper(preg_replace('/\s+/u', '', trim($kembali_ke_jepang))) : null,
                'nama_lengkap' => strtoupper($nama_lengkap),
                'tgl_pulang' => strtoupper($tgl_pulang),
                'pic' => strtoupper($pic),
                'nama_lpk' => strtoupper($nama_lpk),
                'lama_di_jepang' => strtoupper($lama_di_jepang),
                'referensi_kerja' => strtoupper($referensi_kerja),
                'jenis_kelamin' => strtoupper($jenis_kelamin),
                'pendidikan' => strtoupper($pendidikan),
                'tahun_terbit' => strtoupper($tahun_terbit),
                'level_bahasa' => strtoupper($level_bahasa),
                'sensei' => strtoupper($sensei),
                'dokumen' => strtoupper($dokumen),
                'penerjemah' => strtoupper($penerjemah),
                'bidang_kerja_di_jepang' => strtoupper($bidang_kerja_di_jepang),
                'bidang_kerja_pilihan' => strtoupper($bidang_kerja_pilihan),
                'senmongkyu' => strtoupper($senmongkyu),
                'bidang_senmongkyu' => strtoupper($bidang_senmongkyu),
                'jenis_visa' => strtoupper($jenis_visa),
                'nama_tiktok' => strtoupper($nama_tiktok),
                'nama_instagram' => strtoupper($nama_instagram),
                'no_telp_indonesia' => strtoupper($no_telp_indonesia),
                'no_telp_jepang' => strtoupper($no_telp_jepang),
                'email' => strtoupper($email),
                'provinsi' => strtoupper($provinsi),
                'kota' => strtoupper($kota),
                'available' => true,
            ]);
        }
    }
}
