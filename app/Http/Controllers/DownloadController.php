<?php

namespace App\Http\Controllers;

use App\Download;
use Illuminate\Http\Request;

class DownloadController extends Controller
{

    public function index()
    {
        $downloads = Download::all();
        $downloads = Download::paginate(2);

        return View('downloads.index', compact('downloads'));
    }
}
