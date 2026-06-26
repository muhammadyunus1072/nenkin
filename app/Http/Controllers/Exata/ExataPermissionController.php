<?php

namespace App\Http\Controllers\Exata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExataPermissionController extends Controller
{
    public function index()
    {
        return view('app.exata.exata_permission.index');
    }

    public function create()
    {
        return view('app.exata.exata_permission.detail', ["objId" => null]);
    }


    public function edit(Request $request)
    {
        return view('app.exata.exata_permission.detail', ["objId" => $request->id]);
    }
}
