<?php

namespace App\Http\Controllers;

use App\Repositories\Nenkin\NenkinRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function testOcr(Request $request)
    {
        $request->validate([
            'image' => 'required|image'
        ]);
        $folder = 'nenkin/' . Str::uuid();
        $image = $request->file('image')->store($folder, 'public');

        NenkinRepository::create([
            'image' => $image
        ]);

        return response()->json([
            'text' => 'Success'
        ]);
    }
}
