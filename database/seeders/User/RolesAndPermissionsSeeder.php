<?php

namespace Database\Seeders\User;

use App\Helpers\PermissionHelper;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            PermissionHelper::ACCESS_DASHBOARD => [PermissionHelper::TYPE_READ],
            PermissionHelper::ACCESS_USER => PermissionHelper::TYPE_ALL,
            PermissionHelper::ACCESS_ROLE => PermissionHelper::TYPE_ALL,
            PermissionHelper::ACCESS_CONVERT_DATA_ICHIJIKIN => PermissionHelper::TYPE_ALL,
            PermissionHelper::ACCESS_VEHICLE => PermissionHelper::TYPE_ALL,
            PermissionHelper::ACCESS_VEHICLE_USAGE => PermissionHelper::TYPE_ALL,
            PermissionHelper::ACCESS_PERMISSION => PermissionHelper::TYPE_ALL,

            PermissionHelper::ACCESS_EXATA => PermissionHelper::TYPE_ALL,
            PermissionHelper::ACCESS_EXATA_PERMISSION => PermissionHelper::TYPE_ALL,

            'exata_no' => [PermissionHelper::TYPE_READ],
            'exata_tgl_input' => [PermissionHelper::TYPE_READ],
            'exata_habis_kontrak' => [PermissionHelper::TYPE_READ],
            'exata_kembali_ke_jepang' => [PermissionHelper::TYPE_READ],
            'exata_nama_lengkap' => [PermissionHelper::TYPE_READ],
            'exata_tgl_pulang' => [PermissionHelper::TYPE_READ],
            'exata_pic' => [PermissionHelper::TYPE_READ],
            'exata_nama_lpk' => [PermissionHelper::TYPE_READ],
            'exata_lama_di_jepang' => [PermissionHelper::TYPE_READ],
            'exata_referensi_kerja' => [PermissionHelper::TYPE_READ],
            'exata_jenis_kelamin' => [PermissionHelper::TYPE_READ],
            'exata_pendidikan' => [PermissionHelper::TYPE_READ],
            'exata_tahun_terbit' => [PermissionHelper::TYPE_READ],
            'exata_level_bahasa' => [PermissionHelper::TYPE_READ],
            'exata_sensei' => [PermissionHelper::TYPE_READ],
            'exata_dokumen' => [PermissionHelper::TYPE_READ],
            'exata_penerjemah' => [PermissionHelper::TYPE_READ],
            'exata_bidang_kerja_di_jepang' => [PermissionHelper::TYPE_READ],
            'exata_bidang_kerja_pilihan' => [PermissionHelper::TYPE_READ],
            'exata_senmongkyu' => [PermissionHelper::TYPE_READ],
            'exata_bidang_senmongkyu' => [PermissionHelper::TYPE_READ],
            'exata_jenis_visa' => [PermissionHelper::TYPE_READ],
            'exata_nama_tiktok' => [PermissionHelper::TYPE_READ],
            'exata_nama_instagram' => [PermissionHelper::TYPE_READ],
            'exata_no_telp_indonesia' => [PermissionHelper::TYPE_READ],
            'exata_no_telp_jepang' => [PermissionHelper::TYPE_READ],
            'exata_email' => [PermissionHelper::TYPE_READ],
            'exata_provinsi' => [PermissionHelper::TYPE_READ],
            'exata_kota' => [PermissionHelper::TYPE_READ],
            'exata_available' => [PermissionHelper::TYPE_READ],
        ];
        foreach ($permissions as $access => $types) {
            foreach ($types as $type) {
                Permission::create(['name' => PermissionHelper::transform($access, $type)]);
            }
        }

        // create role
        $roles = [
            "Admin" => [
                PermissionHelper::ACCESS_DASHBOARD => [PermissionHelper::TYPE_READ],
                PermissionHelper::ACCESS_USER => PermissionHelper::TYPE_ALL,
                PermissionHelper::ACCESS_PERMISSION => PermissionHelper::TYPE_ALL,
                PermissionHelper::ACCESS_ROLE => PermissionHelper::TYPE_ALL,
                PermissionHelper::ACCESS_CONVERT_DATA_ICHIJIKIN => PermissionHelper::TYPE_ALL,
                PermissionHelper::ACCESS_VEHICLE => PermissionHelper::TYPE_ALL,
                PermissionHelper::ACCESS_VEHICLE_USAGE => PermissionHelper::TYPE_ALL,

                PermissionHelper::ACCESS_EXATA => PermissionHelper::TYPE_ALL,
                PermissionHelper::ACCESS_EXATA_PERMISSION => PermissionHelper::TYPE_ALL,

                'exata_no' => [PermissionHelper::TYPE_READ],
                'exata_tgl_input' => [PermissionHelper::TYPE_READ],
                'exata_habis_kontrak' => [PermissionHelper::TYPE_READ],
                'exata_kembali_ke_jepang' => [PermissionHelper::TYPE_READ],
                'exata_nama_lengkap' => [PermissionHelper::TYPE_READ],
                'exata_tgl_pulang' => [PermissionHelper::TYPE_READ],
                'exata_pic' => [PermissionHelper::TYPE_READ],
                'exata_nama_lpk' => [PermissionHelper::TYPE_READ],
                'exata_lama_di_jepang' => [PermissionHelper::TYPE_READ],
                'exata_referensi_kerja' => [PermissionHelper::TYPE_READ],
                'exata_jenis_kelamin' => [PermissionHelper::TYPE_READ],
                'exata_pendidikan' => [PermissionHelper::TYPE_READ],
                'exata_tahun_terbit' => [PermissionHelper::TYPE_READ],
                'exata_level_bahasa' => [PermissionHelper::TYPE_READ],
                'exata_sensei' => [PermissionHelper::TYPE_READ],
                'exata_dokumen' => [PermissionHelper::TYPE_READ],
                'exata_penerjemah' => [PermissionHelper::TYPE_READ],
                'exata_bidang_kerja_di_jepang' => [PermissionHelper::TYPE_READ],
                'exata_bidang_kerja_pilihan' => [PermissionHelper::TYPE_READ],
                'exata_senmongkyu' => [PermissionHelper::TYPE_READ],
                'exata_bidang_senmongkyu' => [PermissionHelper::TYPE_READ],
                'exata_jenis_visa' => [PermissionHelper::TYPE_READ],
                'exata_nama_tiktok' => [PermissionHelper::TYPE_READ],
                'exata_nama_instagram' => [PermissionHelper::TYPE_READ],
                'exata_no_telp_indonesia' => [PermissionHelper::TYPE_READ],
                'exata_no_telp_jepang' => [PermissionHelper::TYPE_READ],
                'exata_email' => [PermissionHelper::TYPE_READ],
                'exata_provinsi' => [PermissionHelper::TYPE_READ],
                'exata_kota' => [PermissionHelper::TYPE_READ],
                'exata_available' => [PermissionHelper::TYPE_READ],
            ],
            "Member" => [
                PermissionHelper::ACCESS_DASHBOARD => [PermissionHelper::TYPE_READ]
            ]
        ];
        foreach ($roles as $name => $permissions) {
            $role = Role::create(['name' => $name]);

            foreach ($permissions as $access => $types) {
                foreach ($types as $type) {
                    $role->givePermissionTo(PermissionHelper::transform($access, $type));
                }
            }
        }
    }
}
