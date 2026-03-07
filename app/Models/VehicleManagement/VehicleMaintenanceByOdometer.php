<?php

namespace App\Models\VehicleManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;

class VehicleMaintenanceByOdometer extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    protected $fillable = [
        'vehicle_id',
        'name',
        'message',
        'notif_odometer',
        'latest_odometer',
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
        return ($this->vehicle->current_odometer - $this->latest_odometer) >= $this->notif_odometer;
    }
    protected static function onBoot() {}
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }
}
