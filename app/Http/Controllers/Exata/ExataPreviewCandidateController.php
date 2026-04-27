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

    public function create(Request $request)
    {
        $sortBy = isset($request->sortBy) ? $request->sortBy : null;
        $sortDirection = isset($request->sortDirection) ? $request->sortDirection : null;
        return view('app.exata.exata-preview-candidate.detail', ["sortBy" => $sortBy, "sortDirection" => $sortDirection]);
    }


    public function edit(Request $request)
    {
        return view('app.exata.exata-preview-candidate.detail', ["objId" => $request->id]);
    }
}
