<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Obat::orderBy('id','asc')->get();
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
        $dataObat = new Obat;

        $rules = [
            'nama_obat' => 'required',
            'ukuran' => 'required',
            'keterangan' => 'required',
            'tanggal_masuk' => 'required|date',
            'jumlah' => 'required',
            'status' => 'required',
            'kemasan' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'message'=>'Gagal memasukkan data',
                'data' => $validator->errors()
            ]);
        }

        $dataObat->nama_obat = $request->nama_obat;
        $dataObat->ukuran = $request->ukuran;
        $dataObat->keterangan = $request->keterangan;
        $dataObat->tanggal_masuk = $request->tanggal_masuk;
        $dataObat->jumlah = $request->jumlah;
        $dataObat->status = $request->status;
        $dataObat->kemasan = $request->kemasan;


        $post = $dataObat->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses memasukkan data'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Obat::find($id);
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
        $dataObat = Obat::find($id);
        if(empty($dataObat)){
            return response()->json([
                'status' => false,
                'message'=> 'Data tidak ditermukan'
            ],404);
        }

        $rules = [
            'nama_obat' => 'required',
            'ukuran' => 'required',
            'keterangan' => 'required',
            'tanggal_masuk' => 'required|date',
            'jumlah' => 'required',
            'status' => 'required',
            'kemasan' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'message'=>'Gagal mengupdate data',
                'data' => $validator->errors()
            ]);
        }

        $dataObat->nama_obat = $request->nama_obat;
        $dataObat->ukuran = $request->ukuran;
        $dataObat->keterangan = $request->keterangan;
        $dataObat->tanggal_masuk = $request->tanggal_masuk;
        $dataObat->jumlah = $request->jumlah;
        $dataObat->status = $request->status;
        $dataObat->kemasan = $request->kemasan;

        $post = $dataObat->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses mengupdate data'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataObat = Obat::find($id);
        if(empty($dataObat)){
            return response()->json([
                'status' => false,
                'message'=> 'Data tidak ditermukan'
            ],404);
        }

        $post = $dataObat->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses menghapus data'
        ]);
    }
}
