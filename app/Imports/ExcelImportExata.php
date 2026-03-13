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
            $ref = '';
            $tgl_input = '';
            $tgl_pulang = '';
            $pipeline = '';
            $nama_lengkap = '';
            $tanggal_lahir = '';
            $gender = '';
            $pendidikan = '';
            $tahun_terbit = '';
            $level_bahasa = '';
            $lama_di_jepang = '';
            $sensei = '';
            $dokumen = '';
            $penerjemah = '';
            $bidang_kerja_jepang = '';
            $bidang_kerja_pilihan = '';
            $estimasi_gaji = '';
            $domisili = '';
            $penempatan_kerja = '';
            $tgl_siap_kerja = '';
            $senmongkyu = '';
            $bidang_senmongkyu = '';
            $jenis_visa = '';
            $provinsi = '';
            $kota = '';
            $nama_tiktok = '';
            $nama_instagram = '';
            $no_telp_indonesia = '';
            $no_telp_jepang = '';
            $email = '';
            $pic_sales = '';
            $nama_lpk = '';
            $data_import = [
                'ref',
                'tgl_input',
                'pipeline',
                'nama_lengkap',
                'tanggal_lahir',
                'gender',
                'pendidikan',
                'level_bahasa',
                'tahun_terbit',
                'lama_di_jepang',
                'tgl_pulang',
                'sensei',
                'dokumen',
                'penerjemah',
                'estimasi_gaji',
                'domisili',
                'penempatan_kerja',
                'tgl_siap_kerja',
                'bidang_kerja_jepang',
                'bidang_kerja_pilihan',
                'senmongkyu',
                'bidang_senmongkyu',
                'jenis_visa',
                'provinsi',
                'kota',
                'nama_tiktok',
                'nama_instagram',
                'no_telp_indonesia',
                'no_telp_jepang',
                'email',
                'pic_sales',
                'nama_lpk',
            ];

            foreach ($data_import as $index => $data_name) {
                $$data_name = $row[$index];
            }

            $estimasi_gaji = explode('-', preg_replace('/[^0-9\-]/', '', $estimasi_gaji));
            $estimasi_gaji_bottom = $estimasi_gaji[0];
            $estimasi_gaji_top = isset($estimasi_gaji[1]) ? $estimasi_gaji[1] : null;
            $exata = ExataRepository::create([
                'Ref' => strtoupper($ref),
                'TglInput' => strtoupper(preg_replace('/\s+/u', '', trim($tgl_input))) ? strtoupper(preg_replace('/\s+/u', '', trim($tgl_input))) : null,
                'TanggalPulang' => strtoupper(preg_replace('/\s+/u', '', trim($tgl_pulang))) ? strtoupper(preg_replace('/\s+/u', '', trim($tgl_pulang))) : null,
                'pipeline' => strtoupper($pipeline),
                'NamaLengkap' => strtoupper($nama_lengkap),
                'TanggalLahir' => strtoupper(preg_replace('/\s+/u', '', trim($tanggal_lahir))) ? strtoupper(preg_replace('/\s+/u', '', trim($tanggal_lahir))) : null,
                'Gender' => strtoupper(preg_replace('/\s+/u', '', trim($gender))) ? strtoupper(preg_replace('/\s+/u', '', trim($gender))) : null,
                'Pendidikan' => strtoupper($pendidikan),
                'TahunTerbit' => strtoupper($tahun_terbit),
                'LevelBahasa' => strtoupper($level_bahasa),
                'LamaDiJepang' => strtoupper($lama_di_jepang),
                'Sensei' => strtoupper(preg_replace('/\s+/u', '', trim($sensei))) ? strtoupper(preg_replace('/\s+/u', '', trim($sensei))) : null,
                'Dokumen' => strtoupper(preg_replace('/\s+/u', '', trim($dokumen))) ? strtoupper(preg_replace('/\s+/u', '', trim($dokumen))) : null,
                'Penerjemah' => strtoupper(preg_replace('/\s+/u', '', trim($penerjemah))) ? strtoupper(preg_replace('/\s+/u', '', trim($penerjemah))) : null,
                'BidangKerjadiJepang' => strtoupper($bidang_kerja_jepang),
                'BidangKerjaPilihan' => strtoupper($bidang_kerja_pilihan),
                'EstimasiGaji' => $estimasi_gaji_bottom ? $estimasi_gaji_bottom : null,
                'EstimasiGajiTop' => $estimasi_gaji_top ? $estimasi_gaji_top : null,
                'Domisili' => strtoupper($domisili),
                'Penempatankerja' => strtoupper($penempatan_kerja),
                'TglSiapkerja' => strtoupper(preg_replace('/\s+/u', '', trim($tgl_siap_kerja))) ? strtoupper(preg_replace('/\s+/u', '', trim($tgl_siap_kerja))) : null,
                'Senmongkyu' => strtoupper($senmongkyu),
                'BidangSenmongkyu' => strtoupper($bidang_senmongkyu),
                'JenisVisa' => strtoupper($jenis_visa),
                'Provinsi' => strtoupper($provinsi),
                'Kota' => strtoupper($kota),
                'NamaTikTok' => strtoupper($nama_tiktok),
                'NamaInstagram' => strtoupper($nama_instagram),
                'NoTelpIndonesia' => strtoupper($no_telp_indonesia),
                'NoTelpJepang' => strtoupper($no_telp_jepang),
                'email' => strtoupper($email),
                'PICSales' => strtoupper($pic_sales),
                'NamaLPK' => strtoupper($nama_lpk),
            ]);
        }
    }
}
