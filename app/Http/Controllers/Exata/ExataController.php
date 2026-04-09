<?php

namespace App\Http\Controllers\Exata;

use App\Http\Controllers\Controller;
use App\Models\Exata\Exata;
use App\Repositories\Exata\ExataCurriculumVitaeRepository;
use App\Repositories\Exata\ExataJapaneseLanguageCertificateRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

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

    public function view_pdf(Request $request)
    {
        if (!in_array($request->type, array_keys(Exata::FILTER_ATTACHMENT_CHOICE))) {
            abort(404);
        }
        if ($request->type == Exata::FILTER_ATTACHMENT_CV) {
            $document = ExataCurriculumVitaeRepository::find(Crypt::decrypt($request->id));

            $path = $document->file;

            if (!Storage::disk('public')->exists($path)) {
                abort(404);
            }
        }
        if ($request->type == Exata::FILTER_ATTACHMENT_SERTIFIKAT_BAHASA_JEPANG) {
            $document = ExataJapaneseLanguageCertificateRepository::find(Crypt::decrypt($request->id));

            $path = $document->file;

            if (!Storage::disk('public')->exists($path)) {
                abort(404);
            }
        }

        return response()->file(
            storage_path('app/public/' . $path),
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="document.pdf"'
            ]
        );
    }


    public function edit(Request $request)
    {
        return view('app.exata.exata.detail', ["objId" => $request->id]);
    }
}
