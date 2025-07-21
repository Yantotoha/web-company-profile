<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\MasterHead;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PublicController extends Controller
{
    public function index()
    {
        return view('pages.app.index');
    }

    public function getData(): JsonResponse
    {
        $masterHead = MasterHead::select('title','subtitle', 'image')->latest()->first();
        $services = Service::select('title','description', 'image')->get();
      
        $data = [
            'master_head' => $masterHead,
        ];
        return response()->json($data);
    }
}
