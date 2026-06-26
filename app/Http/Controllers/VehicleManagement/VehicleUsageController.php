<?php

namespace App\Http\Controllers\VehicleManagement;

use App\Http\Controllers\Controller;

class VehicleUsageController extends Controller
{
    public function index()
    {
        return view('app.vehicle-management.vehicle-usage.index');
    }

    public function create()
    {
        return view('app.vehicle-management.vehicle-usage.detail', ["objId" => null]);
    }
    public function pricing()
    {
        return view('app.pricing', ["objId" => null]);
    }
}
