<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Repositories\MasterData\Regency\RegencyRepository;
use Illuminate\Http\Request;

class RegencyController extends Controller
{
    public function index()
    {
        return view('app.master-data.regency.index');
    }

    public function create()
    {
        return view('app.master-data.regency.detail', ["objId" => null]);
    }

    public function edit(Request $request)
    {
        return view('app.master-data.regency.detail', ["objId" => $request->id]);
    }

    public function search(Request $request)
    {
        return RegencyRepository::search($request);
    }
}
