<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
     public function index()
    {
        return view('pages.editor.about.index');
    }
}
