<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class DownloadFileController extends Controller
{
    public function getFile(Request $request)
    {
        $file = Storage::disk('public')->get($request->downloadable);

        return (new Response($file, 200))
            ->header('Content-Type', 'application/pdf');
    }
}
