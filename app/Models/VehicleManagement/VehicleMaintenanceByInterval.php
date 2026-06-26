<?php

namespace App\Models\VehicleManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;

class VehicleMaintenanceByInterval extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    protected $fillable = [
        'vehicle_id',
        'name',
        'message',
        'notif_interval',
        'current_interval',
        'is_show',
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
    public function isMaintenance(): bool
    {
        return ($this->current_interval >= $this->notif_interval);
    }

    protected static function onBoot() {}
}
