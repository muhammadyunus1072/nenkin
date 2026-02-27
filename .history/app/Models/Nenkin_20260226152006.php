<?php

namespace App\Models;

use App\Services\VisionOcrService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;

class Nenkin extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    protected $fillable = [
        'image',
        'date',
        'payment_top',
        'payment',
        'income',
        'net',
        'name',
        'address',
        'number',
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
        self::created(function ($model) {
            $service = new VisionOcrService();
            $service->handleDocument($model->id, $model->image);
        });
    }
}
