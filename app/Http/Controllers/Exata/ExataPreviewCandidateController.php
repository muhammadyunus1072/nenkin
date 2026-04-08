<?php

namespace App\Http\Controllers\Exata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExataPreviewCandidateController extends Controller
{
    public function index()
    {
        return view('app.exata.exata-preview-candidate.index');
    }

    public function create()
    {
        return view('app.exata.exata-preview-candidate.detail');
    }


    public function edit(Request $request)
    {
        return view('app.exata.exata-preview-candidate.detail', ["objId" => $request->id]);
    }
}
