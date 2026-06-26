<?php

namespace App\Http\Controllers\VehicleManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        return view('app.vehicle-management.vehicle.index');
    }

    public function create()
    {
        return view('app.vehicle-management.vehicle.detail', ["objId" => null]);
    }


    public function edit(Request $request)
    {
        return view('app.vehicle-management.vehicle.detail', ["objId" => $request->id]);
    }
}
