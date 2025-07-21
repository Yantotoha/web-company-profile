<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Portfolio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    public function index()
    {
        return view('pages.editor.portfolio.index');
    }

    public function getData(Request $request): JsonResponse
    {
        $rescode = 200;
        $cari = $request->input('search', '');
        $start = $request->input('start', 0);
        $limit = $request->input('limit', 10);
        try {
            $query = Portfolio::where('title', 'LIKE', '%'.$cari.'%');
            $portfolio = $query->offset($start)
                ->limit($limit)
                ->get();
            $portfolio_total = $query->count();
            $data['draw'] = intval($request->input('draw'));
            $data['recordsTotal'] = $portfolio_total;
            $data['recordsFiltered'] = $portfolio_total;
            $data['data'] = $portfolio;
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

   public function storeData(Request $request): JsonResponse
{
    date_default_timezone_set('Asia/Jakarta');
    $rescode = 200;
    $categories = Category::select('id','name')->orderBy('name')->get();
    $user = Auth::id();

    try {
        $rules = [
            'title'    => 'required|string|max:255|unique:portfolio,title',
            'client'   => 'required|string|max:255',
            'des'      => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'file'     => 'required|image|mimes:jpeg,png,jpg|max:2048',
            // 'slug' => 'required|string|max:255', ❌ tidak perlu divalidasi dari input
        ];

        $messages = [
            'title.unique' => 'Title sudah digunakan',
            'required'     => ':attribute wajib diisi',
            'string'       => ':attribute harus berupa teks',
            'file.image'   => 'File harus berupa gambar',
            'file.mimes'   => 'Gambar hanya boleh berformat jpeg, png, jpg',
            'file.max'     => 'Ukuran gambar maksimal 2MB',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $v_error = $validator->errors()->all();
            $res = [
                'success'  => 0,
                'messages' => implode(', ', $v_error)
            ];
        } else {
            $validData = $validator->validated();

            // Buat slug dari title
            $validData['slug'] = Str::slug($validData['title']);

            // Proses upload gambar
            $img = $validData['file'];
            $file_name = Str::uuid().'.'.$img->getClientOriginalExtension();
            $path = $img->storeAs('img', $file_name, 'public');

            // Tambahkan data tambahan
            $validData['image'] = $path;
            $validData['created_by'] = $user;
            $validData['category'] = $categories;

            // Simpan ke database
            Portfolio::create($validData);

            $res = [
                'success'  => 1,
                'messages' => 'Success Tambah Data'
            ];
        }

    } catch (QueryException $e) {
        Log::error('QueryException: ' . $e);
        $res = [
            'success'  => 0,
            'messages' => 'Ops terjadi kesalahan saat Proses data'
        ];
    } catch (Exception $e) {
        Log::error('Exception: ' . $e);
        $res = [
            'success'  => 0,
            'messages' => 'Ops terjadi kesalahan pada server'
        ];
    }

    return response()->json($res, $rescode);
}


    public function detail(Request $request): JsonResponse
    {
        $rescode = 200;
        $id = $request->input('id', 0);
        $data = Portfolio::find($id);
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
                'client' => 'required|string|max:255',
                'des' => 'required|string|max:255',
                'category' => 'required|string|max:255',
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
                $portfolio = Portfolio::find($id);
                if ($portfolio) {
                    if($validData['file'] !=null){
                        $filePath = $portfolio['image'];
                        if (Storage::disk('public')->exists($filePath)) {
                            Storage::disk('public')->delete($filePath);
                        }
                        $img = $validData['file'];
                        $file_name = Str::uuid().'.'.$img->getClientOriginalExtension();
                        $path = $img->storeAs('img', $file_name, 'public');
                        $validData['image'] = $path;
                    }
                    $validData['updated_by']=$user;
                    $portfolio->update($validData);
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
            $portfolio = Portfolio::find($id);
            $res = [];
            if ($portfolio) {
                $portfolio->update(['deleted_by'=>$id]);
                $portfolio->delete();
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
