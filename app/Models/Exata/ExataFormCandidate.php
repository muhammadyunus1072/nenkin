<?php

namespace App\Models\Exata;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;

class ExataFormCandidate extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    protected $fillable = [
        'user_id',
        'password',
        'expired_at',
        'status',
        'exata_id',
    ];

    const STATUS_CREATED = 'CREATED';
    const STATUS_SUBMITTED = 'SUBMITTED';
    const STATUS_EXPIRED = 'EXPIRED';

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function exata()
    {
        return $this->belongsTo(Exata::class, 'exata_id', 'id');
    }
}
