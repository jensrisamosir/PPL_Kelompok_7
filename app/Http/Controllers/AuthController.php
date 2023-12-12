<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function dologin(Request $request) {
        // validasi
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials)) {

            // buat ulang session login
            $request->session()->regenerate();

            if (auth()->user()->role_id === 1) {
                // jika user superadmin
                return redirect()->intended('/dokter');
            } else {
                // jika user pegawai
                return redirect()->intended('/asisten');
            }
        }

        // jika email atau password salah
        // kirimkan session error
        return back()->with('error', 'email atau password salah');
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function showAccount () {
        // $users = User::all();

        $pegawai= User::whereHas('role', function ($query) {
            $query->where('role_id', '2');
        })->get();

        return view('dokter.tableAkunAsisten', compact('pegawai'));
    }

//     public function destroy($id){
//     $user = User::find($id);

//     // $this->authorize('delete', $user);

//     $user->delete();

//     return redirect('/showAkun')->with('success', 'Akun Asisten berhasil dihapus.');
// }

    public function destroy(string $id){
        $client = new Client();
    $url = "http://localhost:8000/api/deleteAkun/$id";

    try {
        $response = $client->request('DELETE', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if ($contentArray['status'] !== true) {
            return redirect('/showAkun')->back()->with('error', 'Gagal hapus obat: ' . $contentArray['message']);
        } else {
            return redirect('/showAkun')->back()->with('success', 'Data Obat berhasil dihapus.');
        }
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal hapus obat: ' . $e->getMessage());
    }
    }

//     public function updateProfile(Request $request)
// {
//     $request->validate([
//         'profile_photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//     ]);

//     $user = auth()->user();

//     if ($request->hasFile('profile_photo')) {
//         $profilePhoto = $request->file('profile_photo');
//         $profilePhotoName = time() . '_' . $profilePhoto->getClientOriginalName();
//         $profilePhotoPath = $profilePhoto->storeAs('public/profile_photos', $profilePhotoName);

//         $user->profile_photo = $profilePhotoName;
//         $user->save();
//     }

//     return redirect()->back()->with('success', 'Profile photo has been updated.');
// }

}
