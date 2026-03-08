<?php

namespace App\Http\Controllers\Exata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExataController extends Controller
{
    public function index()
    {
        return view('app.exata.exata.index');
    }

    public function create()
    {
        return view('app.exata.exata.detail', ["objId" => null]);
    }


    public function edit(Request $request)
    {
        return view('app.exata.exata.detail', ["objId" => $request->id]);
    }
}
