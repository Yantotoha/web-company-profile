<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class ContacController extends Controller
{
     public function index()
    {
        return view('pages.editor.contact.index');
    }

    public function getData(Request $request): JsonResponse
    {
        $rescode = 200;
        $cari = $request->input('search', '');
        $start = $request->input('start', 0);
        $limit = $request->input('limit', 10);
        try {
            $query = Contact::where('name', 'LIKE', '%'.$cari.'%');
            $contact = $query->offset($start)
                ->limit($limit)
                ->get();
            $contact_total = $query->count();
            $data['draw'] = intval($request->input('draw'));
            $data['recordsTotal'] = $contact_total;
            $data['recordsFiltered'] = $contact_total;
            $data['data'] = $contact;
        } catch (QueryException $e) {
            $data['error'] = 'Ops terjadi kesalahan saat mengambil data ';
            Log::error('QueryException: '.$e);
            //throw $th;
        } catch (Exception $e) {
            $data['error'] = 'Ops terjadi kesalahan pada server';
            Log::error('Exception: '.$e);
        }

        return response()->json($data, $rescode);
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

    public function deleteData(Request $request): JsonResponse
    {
        date_default_timezone_set('Asia/Jakarta');
        $rescode = 200;
        $id = $request->input('id');
        try {
            $contact = contact::find($id);
            $res = [];
            if ($contact) {
                $contact->update(['deleted_by'=>$id]);
                $contact->delete();
                $res = ['success' => 1, 'messages' => 'Success Delete Data'];
            } else {
                $res = ['success' => 0, 'messages' => 'Data tidak ditemukan'];
            }
        } catch (QueryException $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan saat hapus data '];
            Log::error('QueryException: '.$e->getMessage());
        } catch (Exception $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan pada server '.$e];
            Log::error('Exception: '.$e->getMessage());
        }

        return response()->json($res, $rescode);

    }
}
