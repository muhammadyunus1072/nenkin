<?php

namespace App\Models\Exata;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;

class ExataPreviewCandidate extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    protected $fillable = [
        'exata_id',

        'KodeUnik',
        'TanggalLahir',
        'Gender',
        'Pendidikan',
        'LevelBahasa',
        'LamaDiJepang',
        'EstimasiGaji',
        'EstimasiGajiTop',
        'Domisili',
        'TglSiapkerja',
        'BidangKerjadiJepang',
        'BidangKerjaPilihan',
        'Sensei',
        'Dokumen',
        'Penerjemah',

        'SkillKomputer',
        'SoftSkill',
        'Keterangan',

        'poin_rekomendasi',
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

    protected static function onBoot()
    {
        self::creating(function ($model) {
            if ($model->exata_id) {
                $model = $model->exata->saveInfo($model, false, '');
            }
        });
    }

    public function exata()
    {
        return $this->belongsTo(Exata::class, 'exata_id', 'id');
    }
}
