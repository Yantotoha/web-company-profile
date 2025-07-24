<?php

namespace App\Http\Controllers;

use App\Models\About;
use Exception;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\MasterHead;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

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
        $porto = Portfolio::with('category')->select('id','slug','client','category_id','image')->get();
        $about = About::select('year','title','description','image')->get();
      
        $data = [
            'master_head' => $masterHead,
            'service' => $services,
            'portofolio' => $porto,
            'about' => $about,
        ];
        return response()->json($data);
    }

    public function detail(Request $request):JsonResponse
    {
        $res = [];
        $rescode = 200;
        $slug = $request->query('slug','');
        try{
            $data = Portfolio::with('category')->select('id','title','client','category_id','image','des')->where('slug',$slug)->first();
            if($data){
                $res = ['success'=>1,'data'=>$data];
            }else{
                $res = ['success'=>0, 'message'=>'Data Tidak Di temukan'];
            }
        } catch (QueryException $e) {
            $res = ['success' => 0, 'message' => 'Ops terjadi kesalahan saat mengambil data'];
            Log::error('QueryException: '.$e);
        } catch (Exception $e) {
            $res = ['success' => 0, 'message' => 'Ops terjadi kesalahan pada server'];
            Log::error('Exception: '.$e);
        }
        return response()->json($res,$rescode);
        
    }
}
