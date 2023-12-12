<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Patient::orderBy('id','asc')->get();
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
        $dataPatient = new Patient;

        $rules = [
            'name' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'tanggal_lahir' => 'required|date',
            'wali' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'message'=>'Gagal memasukkan data',
                'data' => $validator->errors()
            ]);
        }

        $dataPatient->name = $request->name;
        $dataPatient->gender = $request->gender;
        $dataPatient->phone_number = $request->phone_number;
        $dataPatient->address = $request->address;
        $dataPatient->tanggal_lahir = $request->tanggal_lahir;
        $dataPatient->wali = $request->wali;

        $post = $dataPatient->save();

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
        $data = Patient::find($id);
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
        $dataPatient = Patient::find($id);
        if(empty($dataPatient)){
            return response()->json([
                'status' => false,
                'message'=> 'Data tidak ditermukan'
            ],404);
        }

        $rules = [
            'name' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'tanggal_lahir' => 'required|date',
            'wali' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'message'=>'Gagal mengupdate data',
                'data' => $validator->errors()
            ]);
        }

        $dataPatient->name = $request->name;
        $dataPatient->gender = $request->gender;
        $dataPatient->phone_number = $request->phone_number;
        $dataPatient->address = $request->address;
        $dataPatient->tanggal_lahir = $request->tanggal_lahir;
        $dataPatient->wali = $request->wali;

        $post = $dataPatient->save();

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
        $dataPatient = Patient::find($id);
        if(empty($dataPatient)){
            return response()->json([
                'status' => false,
                'message'=> 'Data tidak ditermukan'
            ],404);
        }

        $post = $dataPatient->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses menghapus data'
        ]);
    }
}
