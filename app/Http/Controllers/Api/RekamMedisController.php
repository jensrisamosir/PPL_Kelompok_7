<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MedicalRecord::orderBy('id','asc')->get();
        return response()->json([
            'status'=>true,
            'message'=>'Data ditemukan',
            'data'=>$data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $dataRekamMedis = new MedicalRecord();

    $rules = [
        'pasien_id' => 'required',
        'obat_id' => 'required',
        'jumlah_dipakai' => 'required',
        'aturan' => 'required',
        'keterangan' => 'required',
        'diagnosa' => 'required',
        'keluhan' => 'required',
        'tinggi' => 'required',
        'berat' => 'required',
        'jenis_penyakit' => 'required'
    ];

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Gagal memasukkan data',
            'data' => $validator->errors()
        ]);
    }

    try {
        $dataRekamMedis->pasien_id = $request->idp;
        $dataRekamMedis->obat_id = $request->obat;
        $dataRekamMedis->obat_id2 = $request->obat2;
        $dataRekamMedis->obat_id3 = $request->obat3;
        $dataRekamMedis->obat_id4 = $request->obat4;
        $dataRekamMedis->obat_id5 = $request->obat5;
        $dataRekamMedis->jumlah_dipakai = $request->jumlah_dipakai;
        $dataRekamMedis->jumlah_dipakai2 = $request->jumlah_dipakai2;
        $dataRekamMedis->jumlah_dipakai3 = $request->jumlah_dipakai3;
        $dataRekamMedis->jumlah_dipakai4 = $request->jumlah_dipakai4;
        $dataRekamMedis->jumlah_dipakai5 = $request->jumlah_dipakai5;
        $dataRekamMedis->aturan = $request->aturan;
        $dataRekamMedis->aturan2 = $request->aturan2;
        $dataRekamMedis->aturan3 = $request->aturan3;
        $dataRekamMedis->aturan4 = $request->aturan4;
        $dataRekamMedis->aturan5 = $request->aturan5;
        $dataRekamMedis->keterangan = $request->keterangan;
        $dataRekamMedis->keterangan2 = $request->keterangan2;
        $dataRekamMedis->keterangan3 = $request->keterangan3;
        $dataRekamMedis->keterangan4 = $request->keterangan4;
        $dataRekamMedis->keterangan5 = $request->keterangan5;
        $dataRekamMedis->diagnosa = $request->diagnosa;
        $dataRekamMedis->keluhan = $request->keluhan;
        $dataRekamMedis->tinggi = $request->tinggi;
        $dataRekamMedis->berat = $request->berat;
        $dataRekamMedis->jenis_penyakit = $request->jenis_penyakit;

        $dataRekamMedis->save();

        // Find the Obat model by ID
        $obat = Obat::find($request->obat);

        // Check if the Obat model is found
        if ($obat) {
            $obat->jumlah -= $request->jumlah_dipakai;
            $obat->jumlah -= $request->jumlah_dipakai2;
            $obat->jumlah -= $request->jumlah_dipakai3;
            $obat->jumlah -= $request->jumlah_dipakai4;
            $obat->jumlah -= $request->jumlah_dipakai5;

            $obat->save();
        } else {
            // Handle the case where the Obat is not found
            return response()->json([
                'status' => false,
                'message' => 'Gagal memasukkan data. Obat tidak ditemukan.'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Sukses memasukkan data'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Gagal memasukkan data',
            'error' => $e->getMessage()
        ]);
    }
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = MedicalRecord::find($id);
        if($data){
            return response()->json([
                'status'=>true,
                'message'=>'Data ditemukan',
                'data'=>$data 
            ],200);
        }else{
            return response()-> json([
                'status'=>false,
                'message'=>'Data tidak ditemukan',
                'data'=>$data
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
