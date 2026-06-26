<?php

namespace App\Http\Controllers\Exata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExataAttachmentController extends Controller
{
    public function detail(Request $request)
    {
        return view('app.exata.exata-attachment.detail', [
            "objId" => $request->exata_id,
            "type" => $request->type,
        ]);
    }
}
