<?php

namespace App\Http\Controllers\Exata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExataHistoryFilePreviewController extends Controller
{
    public function index()
    {
        return view('app.exata.exata-history-file-preview.index');
    }

    public function create()
    {
        return view('app.exata.exata-history-file-preview.detail', ["objId" => null]);
    }

    public function download(string $path)
    {
        $disk = 'private';

        $path = urldecode($path); // ⭐ IMPORTANT
        logger($path);
        abort_unless(
            Storage::disk($disk)->exists($path),
            404
        );

        return Storage::disk($disk)->download($path);
    }

    public function edit(Request $request)
    {
        return view('app.exata.exata-history-file-preview.detail', ["objId" => $request->id]);
    }
}
