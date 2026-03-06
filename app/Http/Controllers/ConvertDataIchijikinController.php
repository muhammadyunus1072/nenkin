<?php

namespace App\Http\Controllers;

class ConvertDataIchijikinController extends Controller
{
    public function index()
    {
        return view('app.convert-data-ichijikin.index');
    }

    public function create()
    {
        return view('app.convert-data-ichijikin.detail', ["objId" => null]);
    }
}
