<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class AsistenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $data = User::join('roles', 'users.role_id', '=', 'roles.id')
                ->where('roles.id', 2) // Change to 'roles.id' if that's the correct column name
                ->orderBy('users.id', 'asc')
                ->get();

    return response()->json([
        'status' => true,
        'message' => 'Data ditemukan',
        'data' => $data
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
        $dataAsisten = new User;

        $rules = [ 
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|in:1,2',
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'message'=>'Gagal memasukkan data',
                'data' => $validator->errors()
            ]);
        }

        $dataAsisten->name = $request->name;
            $dataAsisten->email = $request->email;
            $dataAsisten->password = Hash::make($request->password);
            $dataAsisten->role_id = $request->role_id;

        $post = $dataAsisten->save();

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
    $data = User::join('roles', 'users.role_id', '=', 'roles.id')
                ->where('roles.id', 2) // Change to 'roles.id' if that's the correct column name
                ->find($id);

    if ($data) {
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan',
            'data' => $data
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
        $dataAsisten = User::find($id);
        if(empty($dataAsisten)){
            return response()->json([
                'status' => false,
                'message'=> 'Data tidak ditermukan'
            ],404);
        }

        $post = $dataAsisten->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses menghapus data'
        ]);
    }
}
