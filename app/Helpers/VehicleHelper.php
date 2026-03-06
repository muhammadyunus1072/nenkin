<?php

namespace App\Helpers;

class VehicleHelper
{

    public static function fuelPercentage($max_range, $current_range)
    {
        return ($current_range / $max_range) * 100;
    }
}
