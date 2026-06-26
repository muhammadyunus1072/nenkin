<?php

namespace App\Http\Controllers\Exata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExataFormCandidateController extends Controller
{
    public function index()
    {
        return view('app.exata.exata-form-candidate.index');
    }

    public function create()
    {
        return view('app.exata.exata-form-candidate.detail', ["objId" => null]);
    }


    public function edit(Request $request)
    {
        return view('app.exata.exata-form-candidate.detail', ["objId" => $request->id]);
    }

    public function form(Request $request)
    {
        return view('app.exata.exata-form-candidate.form', ["objId" => $request->id]);
    }
}
