<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\About;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
     public function index()
    {
        return view('pages.editor.about.index');
    }

    public function getData(Request $request): JsonResponse
    {
        $rescode = 200;

        try {
            $cari = $request->input('search.value', '');
            $start = $request->input('start', 0);
            $limit = $request->input('length', 10);

            Log::info('Start getData', ['cari' => $cari, 'start' => $start, 'limit' => $limit]);

            $query = About::query();

            $recordsTotal = $query->count();

            if (!empty($cari)) {
                $query->where('title', 'LIKE', '%' . $cari . '%');
            }

            $recordsFiltered = $query->count();

            $about = $query->offset($start)
                ->limit($limit)
                ->get();

            // Ubah data jadi array jika butuh transformasi
            $data = [
                'draw' => intval($request->input('draw')),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => $about
            ];
        } catch (\Exception $e) {
            Log::error('About getData error: ' . $e->getMessage());
            $data = ['error' => 'Ops terjadi kesalahan pada server'];
        }

        return response()->json($data, $rescode);
    }

    
    public function storeData(Request $request): JsonResponse
    {
        date_default_timezone_set('Asia/Jakarta');
        $rescode = 200;
        $user = Auth::user()->id;
        try {
            $rules = [
                'title' => 'required|string|max:255|unique:about,title',
                'year' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ];
            $massages = [
                'title.unique' => 'title sudah digunakan',
                'required' => ':attribute wajib diisi',
                'string' => ':attribute harus bertipe string',
                'max' => ':attribute tidak boleh lebih dari 2MB',
                'file.image' => ':attribute tipe file harus :image',
                'file.mimes' => ':attribute tipe gambar hanya boleh :mimes',
                
            ];
            $data = $request->all();
            $validator = Validator::make($data, $rules, $massages);
            if ($validator->fails()) {
                $v_error = $validator->errors()->all();
                // Jika validasi gagal, kembalikan pesan kesalahan
                $res = ['success' => 0, 'messages' => implode(',', $v_error)];
            } else {
                $validData = $validator->validate();
                $img = $validData['file'];
                $file_name = Str::uuid().'.'.$img->getClientOriginalExtension();
                $path = $img->storeAs('img', $file_name, 'public');
                $validData['created_by']=$user;
                $validData['image'] = $path;
                $in = About::create($validData);
                $res = ['success' => 1, 'messages' => 'Success Tambah Data'];
            }
        } catch (QueryException $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan saat Proses data'];
            Log::error('QueryException: '.$e);
        } catch (Exception $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan pada server'];
            Log::error('Exception: '.$e);
        }

        return response()->json($res, $rescode);
    }

    public function detail(Request $request): JsonResponse
    {
        $rescode = 200;
        $id = $request->input('id', 0);
        $data = About::find($id);
        $res = [];
        if ($data) {
            $res = ['success' => 1, 'data' => $data];
        } else {
            $res = ['success' => 0, 'messages' => 'Data tidak ditemukan'];
        }

        return response()->json($res, $rescode);
    }
    public function updateData(Request $request): JsonResponse
    {
        date_default_timezone_set('Asia/Jakarta');
        $rescode = 200;
        $user = Auth::user()->id;
        $id = $request->input('id', 0);
        try {
            if (!$request->filled('file')) {
                $request->merge(['file' => null]);
            }
            $rules = [
                'title' => 'required|string|max:255',
                'year' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ];
            $massages = [
                'required' => ':attribute wajib diisi',
                'string' => ':attribute harus bertipe string',
                'max' => ':attribute tidak boleh lebih dari :max',
                'file.image' => ':attribute tipe file harus :image',
                'file.mimes' => ':attribute tipe gambar hanya boleh :mimes',
                
            ];
            $data = $request->all();
            $validator = Validator::make($data, $rules, $massages);
            if ($validator->fails()) {
                $v_error = $validator->errors()->all();
                $res = ['success' => 0, 'messages' => implode(',', $v_error)];
            } else {
                $validData = $validator->validate();
                $about = About::find($id);
                if ($about) {
                    if($validData['file'] !=null){
                        $filePath = $about['image'];
                        if (Storage::disk('public')->exists($filePath)) {
                            Storage::disk('public')->delete($filePath);
                        }
                        $img = $validData['file'];
                        $file_name = Str::uuid().'.'.$img->getClientOriginalExtension();
                        $path = $img->storeAs('img', $file_name, 'public');
                        $validData['image'] = $path;
                    }
                    $validData['updated_by']=$user;
                    $about->update($validData);
                    $res = ['success' => 1, 'messages' => 'Success Update Data'];
                } else {
                    $res = ['success' => 0, 'messages' => 'Data tidak ditemukan'];
                }
            }
        } catch (QueryException $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan saat update data'];
            Log::error('QueryException: '.$e);
        } catch (Exception $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan pada server'];
            Log::error('Exception: '.$e);
        }

        return response()->json($res, $rescode);
    }
    public function deleteData(Request $request): JsonResponse
    {
        date_default_timezone_set('Asia/Jakarta');
        $rescode = 200;
        $id = $request->input('id');
        try {
            $about = About::find($id);
            $res = [];
            if ($about) {
                $about->update(['deleted_by'=>$id]);
                $about->delete();
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
