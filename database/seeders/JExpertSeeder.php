<?php

namespace Database\Seeders;

use App\Repositories\Exata\ExataRepository;
use Illuminate\Database\Seeder;

class JExpertSeeder extends Seeder
{
    public function run()
    {
        $file = storage_path('app/jexpert.csv');

        $rows = array_map('str_getcsv', file($file));

        $data = collect($rows)->map(function ($row) {

            $d = [
                "id",
                "Ref",
                "TglInput",
                "Pipeline",
                "NamaLengkap",
                "TanggalLahir",
                "Gender",
                "Pendidikan",
                "LevelBahasa",
                "TahunTerbit",
                "LamaDiJepang",
                "TanggalPulang",
                "Sensei",
                "Dokumen",
                "Penerjemah",
                "EstimasiGaji",
                "EstimasiGajiTop",
                "Domisili",
                "Penempatankerja",
                "TglSiapkerja",
                "BidangKerjadiJepang",
                "BidangKerjaPilihan",
                "Senmongkyu",
                "BidangSenmongkyu",
                "JenisVisa",
                "Provinsi",
                "Kota",
                "NamaTikTok",
                "NamaInstagram",
                "NoTelpIndonesia",
                "NoTelpJepang",
                "Email",
                "PICSales",
                "NamaLPK",
                "Keterangan",
                "Available",
            ];
            $return = [];
            foreach ($d as $index => $item) {
                $return[$item] = $row[$index] ? $row[$index] : null;
            }

            ExataRepository::create($return);
        })
            ->toArray();
    }
}
