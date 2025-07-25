<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\About;
use App\Models\Contact;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\MasterHead;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

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

     public function storeMessageContact(Request $request):JsonResponse
    {
        date_default_timezone_set('Asia/jakarta');
        $rescode = 200;
        $res= [];
        try {
            //validation
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|email:dns|max:255',
                'phone' => 'required|string|max:15',
                'message' => 'required|string|max:255',
            ];
            $messages = [
                'required' => ':attribute wajib di isi',
                'string' =>':attribute wajib bertipe text atau string',
                'max' =>':attribute tidak boleh lebih dari max:',
                'email.dns' =>'domain email tidak valid',
                'email' =>'email tidak valid',
            ];
            $data = $request->all();
            $validator = Validator::make($data,$rules,$messages);
            if($validator->fails()){
                $v_error =$validator->errors()->all();
                $res = ['success'=>0, 'messages'=> implode(',',$v_error)];
            }else{
                $valiData =$validator->validate();
                Contact::create($valiData);
                 $res = ['success'=>1, 'messages'=> 'success'];
            }
        } catch (QueryException $e) {
            $res = ['success' => 0, 'message' => 'Ops terjadi kesalahan saat proses data'];
            Log::error('QueryException: '.$e);
        } catch (Exception $e) {
            $res = ['success' => 0, 'message' => 'Ops terjadi kesalahan pada server'];
            Log::error('Exception: '.$e);
        }
        return response()->json($res,$rescode);
    
    }
}
