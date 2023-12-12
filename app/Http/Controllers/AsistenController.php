<?php

namespace App\Http\Controllers;


use App\Models\MedicalRecord;
use App\Models\Obat;
use App\Models\User;
use App\Models\Patient;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AsistenController extends Controller
{
     public function index() {

        $startDate = Carbon::now()->subMonth(); // Tanggal satu bulan yang lalu
        $endDate = Carbon::now(); // Tanggal saat ini
    
        $countPerBulan = MedicalRecord::whereBetween('created_at', [$startDate, $endDate])
            ->count();
            
            $count = Patient::count();
            $count2 = Obat::count();
            $countTersedia = Obat::where('status', 'tersedia') -> count ();
            $countTidakTersedia = Obat::where('status', 'tidak tersedia')->count();
            $countPasienHariIni = MedicalRecord::whereDate('created_at', Carbon::today())->count();

            return view('asisten.index',[
                'count'=>$count , 
                'count2' => $count2, 
                'countTersedia' => $countTersedia, 
                'countTidakTersedia' => $countTidakTersedia, 
                'countPerBulan' => $countPerBulan,
                'countPasienHariIni' => $countPasienHariIni,
            ]);
        }

    

    public function show(Request $request){
        
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/showAkun";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];

        // $asisten = User::query();
        // $asisten -> select('users.*', 'name');
        // $asisten -> where('role_id', '2');
        // if(!empty($request->asisten)) {
        //     $asisten->where('name', 'like', '%'.$request->asisten.'%');
        // }
        // $pegawai = $asisten->get();

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10; // You can set the number of items per page here
        $path = LengthAwarePaginator::resolveCurrentPath();

        $dataCollection = collect($data);

        $currentPageItems = $dataCollection
            ->slice(($currentPage - 1) * $perPage, $perPage)
            ->all();

        $data = new LengthAwarePaginator(
            $currentPageItems,
            count($dataCollection),
            $perPage,
            $currentPage,
            ['path' => $path]
        );


        return view('dokter.tableAkunAsisten', compact('pegawai' , 'data'));


    }
    
}
