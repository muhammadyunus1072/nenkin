<?php

namespace App\Models\Exata;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;

class Exata extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    protected $fillable = [

        'no',
        'tgl_input',
        'habis_kontrak',
        'kembali_ke_jepang',
        'nama_lengkap',
        'tgl_pulang',
        'pic',
        'nama_lpk',
        'lama_di_jepang',
        'referensi_kerja',
        'jenis_kelamin',
        'pendidikan',
        'tahun_terbit',
        'level_bahasa',
        'sensei',
        'dokumen',
        'penerjemah',
        'bidang_kerja_di_jepang',
        'bidang_kerja_pilihan',
        'senmongkyu',
        'bidang_senmongkyu',
        'jenis_visa',
        'nama_tiktok',
        'nama_instagram',
        'no_telp_indonesia',
        'no_telp_jepang',
        'email',
        'provinsi',
        'kota',
        'available',
    ];

    protected $guarded = ['id'];

    public function isDeletable()
    {
        return true;
    }

    public function isEditable()
    {
        return true;
    }

    protected static function onBoot() {}
}
