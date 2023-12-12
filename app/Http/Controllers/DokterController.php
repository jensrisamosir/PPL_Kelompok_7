<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use Illuminate\Support\Carbon;

class DokterController extends Controller
{
    public function index() {

        $startDate = Carbon::now()->subMonth(); // Tanggal satu bulan yang lalu
        $endDate = Carbon::now(); // Tanggal saat ini
    
        $countPerBulan = MedicalRecord::whereBetween('created_at', [$startDate, $endDate])
            ->count();
            
            $count = Patient::count();
            $count2 = Obat::count();
            $countTersedia = Obat::where('status', '=','Tersedia') -> count ();
            $countTidakTersedia = Obat::where('status','=', 'Habis')->count();
            $countKategoriRingan = MedicalRecord::where('jenis_penyakit', '=', 'Ringan')->count();
            $countKategoriSedang = MedicalRecord::where('jenis_penyakit', '=','Sedang')->count();
            $countKategoriBerat = MedicalRecord::where('jenis_penyakit', '=', 'Berat')->count();
            $countPasienHariIni = MedicalRecord::whereDate('created_at', Carbon::today())->count();

            return view('dokter.index',[
                'count'=>$count , 
                'count2' => $count2, 
                'countTersedia' => $countTersedia, 
                'countTidakTersedia' => $countTidakTersedia, 
                'countPerBulan' => $countPerBulan,
                'countPasienHariIni' => $countPasienHariIni,
                'countKategoriRingan' =>    $countKategoriRingan,
                'countKategoriSedang' =>    $countKategoriSedang,
                'countKategoriBerat' =>    $countKategoriBerat,

            ]);
        }


} 
