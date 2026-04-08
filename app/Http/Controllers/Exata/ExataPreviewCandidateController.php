<?php

namespace App\Http\Controllers\Exata;

use App\Http\Controllers\Controller;
use App\Repositories\Exata\ExataPreviewCandidateRepository;
use Illuminate\Http\Request;

class ExataPreviewCandidateController extends Controller
{
    public function index()
    {
        return view('app.exata.exata-preview-candidate.index');
    }

    public function create()
    {
        $data = ExataPreviewCandidateRepository::datatable()->get();
        return view('app.exata.exata-preview-candidate.detail', ['data' => $data]);
    }


    public function edit(Request $request)
    {
        return view('app.exata.exata-preview-candidate.detail', ["objId" => $request->id]);
    }
}
