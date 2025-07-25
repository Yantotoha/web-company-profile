<?php

namespace App\Http\Controllers\admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.editor.dashboard.index');
    }

    public function notification():JsonResponse
    {
   
        $contacts = \App\Models\Contact::where('is_read', 0)
            ->latest()
            ->take(5)
            ->get();

        return response()->json([
            'contact' => $contacts,             // berisi data pesan (dengan id, name, message, dll)
            'total' => $contacts->count(),     // jumlah pesan unread
        ]);
    }

    public function show($id)
    {
        $message = Contact::findOrFail($id);

        if ($message->is_read == 0) {
            $message->is_read = 1;
            $message->save();
        }

        return view('pages.editor.contact.show', compact('message'));
    }

}
