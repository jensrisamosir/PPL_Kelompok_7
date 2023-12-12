<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreateAsistenController extends Controller
{
    public function create (){
        return view ('pasien');
    }
    // public function store(Request $request) {
    //     // Validasi input
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8|confirmed',
    //         'role_id' => 'required|in:1,2',
    //     ]);
    //         // Buat user baru
    //         $user = new User;

    //         $user->name = $request->name;
    //         $user->email = $request->email;
    //         $user->password = Hash::make($request->password);
    //         $user->role_id = $request->role_id;
            
    //         $user->save();

    //         return redirect()->back()->with('success', 'Akun Asisten Berhasil Ditambahkan');
    // }

    public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'password' => 'required|min:6|confirmed',
        'password_confirmation' => 'required|min:6',
    ]);

    // If validation fails, Laravel will automatically redirect back with errors

    $dataAsisten = new User;

    $dataAsisten->name = $request->name;
    $dataAsisten->email = $request->email;
    $dataAsisten->password = Hash::make($request->password);
    $dataAsisten->password_confirmation = Hash::make($request->password_confirmation);
    $dataAsisten->role_id = $request->role_id;

    $payload = [
        'name' => $dataAsisten->name,
        'email' => $dataAsisten->email,
        'password' => $dataAsisten->password,
        'role_id' => $dataAsisten->role_id
    ];

    $client = new Client();
    $url = "http://127.0.0.1:8000/api/createAsisten";
    $response = $client->request('POST', $url, [
        'headers' => ['Content-type' => 'application/json'],
        'body' => json_encode($payload)
    ]);

    $content = $response->getBody()->getContents();
    $contentArray = json_decode($content, true);
    if ($contentArray['status'] != true) {
        echo "Gagal tambah asisten";
    } else {
        return redirect()->back()->with('success', 'Akun Asisten Berhasil Ditambahkan');
    }
}
}