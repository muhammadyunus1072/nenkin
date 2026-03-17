<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    public function run()
    {
        $file = storage_path('app/provinces.csv');

        $rows = array_map('str_getcsv', file($file));

        $data = collect($rows)->map(function ($row) {

            $name = strtoupper($row[1]);

            return [
                'name' => trim($name),
            ];
        })
            ->unique('name')
            ->values()
            ->toArray();

        DB::table('regencies')->insert($data);
    }
}
