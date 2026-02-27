<?php

namespace App\Http\Controllers;

class NenkinController extends Controller
{
    public function index()
    {
        return view('app.nenkin.index');
    }

    public function create()
    {
        return view('app.nenkin.detail', ["objId" => null]);
    }
}
