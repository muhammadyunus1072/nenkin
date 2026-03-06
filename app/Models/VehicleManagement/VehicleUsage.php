<?php

namespace App\Models\VehicleManagement;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;

class VehicleUsage extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    protected $fillable = [

        'vehicle_id',

        // START
        'is_started',

        'start_odometer',
        'start_fuel',
        'start_etoll_balance',

        'start_tire_condition',
        'start_light_condition',
        'start_exterior_condition',
        'start_interior_condition',

        // END
        'is_done',

        'end_odometer',
        'end_fuel',
        'end_etoll_balance',

        'end_tire_condition',
        'end_light_condition',
        'end_exterior_condition',
        'end_interior_condition',

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
            $model->user_id = auth()->user()->id;
            $model->user_name = auth()->user()->name;
        });
        self::updated(function ($model) {
            $model->vehicle()->update([
                'current_odometer' => $model->end_odometer
            ]);
            $model->vehicle->vehicleMaintenanceByIntervals->each(function ($maintenance) {
                $maintenance->increment('current_interval');
            });
        });
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
