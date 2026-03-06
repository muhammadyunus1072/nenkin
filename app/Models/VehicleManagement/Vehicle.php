<?php

namespace App\Models\VehicleManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    protected $fillable = [
        'image',
        'name',
        'is_active',
        'number_plate',
        'max_range',
        'current_odometer',
        'lat',
        'lng',
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

    public function vehicleMaintenanceByIntervals()
    {
        return $this->hasMany(VehicleMaintenanceByInterval::class, 'vehicle_id', 'id');
    }

    public function vehicleBookingActives()
    {
        return $this->hasMany(VehicleBooking::class, 'vehicle_id', 'id')
            ->where('start_time', '>=', now());
    }

    public function vehicleUsageOngoing()
    {
        return $this->hasOne(VehicleUsage::class, 'vehicle_id', 'id')
            ->where('is_started', true)
            ->where('is_done', false);
    }

    public function vehicleMaintenanceByOdometers()
    {
        return $this->hasMany(VehicleMaintenanceByOdometer::class, 'vehicle_id', 'id');
    }

    public function lastVehicleUsage()
    {
        return $this->hasOne(VehicleUsage::class)->latest('id');
    }
}
