<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        return view('pages.editor.category.index');
    }

    public function getData(Request $request): JsonResponse
    {
        $rescode = 200;
        $cari = $request->input('search', '');
        $start = $request->input('start', 0);
        $limit = $request->input('limit', 10);
        try {
            $query = Category::where('name', 'LIKE', '%'.$cari.'%');
            $category = $query->offset($start)
                ->limit($limit)
                ->get();
            $category_total = $query->count();
            $data['draw'] = intval($request->input('draw'));
            $data['recordsTotal'] = $category_total;
            $data['recordsFiltered'] = $category_total;
            $data['data'] = $category;
        } catch (QueryException $e) {
            Log::error('Kategori GetData Error: ' . $e->getMessage());
            $data['error'] = 'Ops terjadi kesalahan saat mengambil data ';
            Log::error('QueryException: '.$e);
            //throw $th;
        } catch (Exception $e) {
            $data['error'] = 'Ops terjadi kesalahan pada server';
            Log::error('Exception: '.$e);
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
                'name' => 'required|string|max:255|unique:categories,name',
                'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ];
            $massages = [
                'name.unique' => 'name sudah digunakan',
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
                $in = Category::create($validData);
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
        $data = Category::find($id);
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
                'name' => 'required|string|max:255',
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
                $category = Category::find($id);
                if ($category) {
                    if($validData['file'] !=null){
                        $filePath = $category['image'];
                        if (Storage::disk('public')->exists($filePath)) {
                            Storage::disk('public')->delete($filePath);
                        }
                        $img = $validData['file'];
                        $file_name = Str::uuid().'.'.$img->getClientOriginalExtension();
                        $path = $img->storeAs('img', $file_name, 'public');
                        $validData['image'] = $path;
                    }
                    $validData['updated_by']=$user;
                    $category->update($validData);
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
}
