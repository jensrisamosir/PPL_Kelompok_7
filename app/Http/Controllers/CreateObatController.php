<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Obat;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;

class CreateObatController extends Controller
{
    public function index (){
        return view ('asisten.create_obat');
    }

    public function store(Request $request)
{
    // Validate the request...

    $obat = new Obat;

    $obat->nama_obat = $request->nama_obat;
    $obat->keterangan = $request->keterangan;
    $obat->tanggal_masuk = $request->tanggal_masuk;
    $obat->jumlah = $request->jumlah;
    $obat->kemasan = $request->kemasan;
    $obat->singkatan = $request->singkatan;
    $obat->ukuran = $request->ukuran;
    $jumlah = $request->jumlah;

    if ($jumlah == 0) {
        $status = 'Tidak Tersedia';
    } else {
        $status = 'Tersedia';
    }

    $obat->status = $status;

    // Commenting out the local save as it's now handled by the API
    // $obat->save();

    // Construct the request payload for the API
    $payload = [
        'nama_obat' => $obat->nama_obat,
        'keterangan' => $obat->keterangan,
        'tanggal_masuk' => $obat->tanggal_masuk,
        'jumlah' => $obat->jumlah,
        'kemasan' => $obat->kemasan,
        'singkatan' => $obat->singkatan,
        'ukuran' => $obat->ukuran,
        'status' => $status,
    ];

    // Send the request to the API
    $client = new Client();
    $url = "http://127.0.0.1:8000/api/obat";
    $response = $client->request('POST', $url, [
        'headers' => ['Content-type' => 'application/json'],
        'body' => json_encode($payload)
    ]);

    // Handle the API response
    $content = $response->getBody()->getContents();
    $contentArray = json_decode($content, true);

    if ($contentArray['status'] !== true) {
        echo "Gagal tambah obat";
    } else {
        return redirect()->back()->with('success', 'Data Obat Telah Ditambahkan');
    }
}


    public function show(Request $request) {
        $filter = $request->input('filter');

    $client = new Client();
    $url = "http://127.0.0.1:8000/api/obat/show";

    if ($filter == 'habis') {
        $url .= "?filter=habis";
    } elseif ($filter == 'tersedia') {
        $url .= "?filter=tersedia";
    }

    $response = $client->request('GET', $url);
    $content = $response->getBody()->getContents();
    $contentArray = json_decode($content, true);
    $data = $contentArray['data'];

    // Manually create a LengthAwarePaginator instance
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

    return view('asisten.show_obat', ['data' => $data, 'filter' => $filter]);
    }

    

    // public function destroy($id){
    //     $data = Obat::findOrFail($id);
    
    //     $data->delete();
    
    //     return redirect()->back()->with('success', 'Data Obat berhasil dihapus.');
    // }

    public function destroy(string $id)
{
    $client = new Client();
    $url = "http://localhost:8000/api/obat/$id";

    try {
        $response = $client->request('DELETE', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if ($contentArray['status'] !== true) {
            return redirect()->back()->with('error', 'Gagal hapus obat: ' . $contentArray['message']);
        } else {
            return redirect()->back()->with('success', 'Data Obat berhasil dihapus.');
        }
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal hapus obat: ' . $e->getMessage());
    }
}


    // public function edit (Obat $obat){
    //     return view('asisten.edit_obat', ['obat' => $obat]);
        
    // }

    public function edit (string $id){
        try {
            $client = new Client();
            $url = "http://127.0.0.1:8000/api/obat/$id";
            $response = $client->request('GET', $url);
            $content = $response->getBody()->getContents();
            $contentArray = json_decode($content, true);

            if ($contentArray['status'] !== true) {
                return redirect()->back()->withErrors(['error' => 'Gagal mengambil data obat']);
            } else {
                $obat = $contentArray['data'];
                return view('asisten.edit_obat', ['obat' => $obat]);
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            Log::error("Gagal melakukan permintaan ke server: " . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Gagal melakukan permintaan ke server: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            Log::error("Terjadi kesalahan: " . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // public function update (Request $request , Obat $obat){
    //     // $patient->id = $request->id;
    //     $obat->nama_obat = $request->nama_obat;
    //     $obat->keterangan = $request->keterangan;
    //     $obat->tanggal_masuk= $request->tanggal_masuk;
    //     $obat->jumlah = $request->jumlah;
    //     $obat->kemasan = $request->kemasan;
    //     $obat->singkatan = $request->singkatan;
    //     $obat->update();

    //     return redirect()->route('obat.show');
    
    // }

    public function update(Request $request, string $id)
{
    try {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/obat/$id";

        // Get the existing patient data
        $response = $client->request('GET', $url);
        $contentArray = json_decode($response->getBody()->getContents(), true);

        if ($contentArray['status'] !== true) {
            return redirect()->route('obat.edit', ['id' => $id])->withErrors(['error' => 'Gagal mengambil data pasien']);
        }

        // Merge existing data with the updated data
        $obat = $contentArray['data'];
        $updatedData = array_merge($obat, $request->all());

        // Update patient data
        $urlUpdate = "http://127.0.0.1:8000/api/obat/$id";
        $responseUpdate = $client->request('PUT', $urlUpdate, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($updatedData)
        ]);

        $contentArrayUpdate = json_decode($responseUpdate->getBody()->getContents(), true);

        if ($contentArrayUpdate['status'] !== true) {
            return redirect()->route('obat.edit', ['id' => $id])->withErrors(['error' => 'Gagal update obat: ' . $contentArrayUpdate['message']]);
        } else {
            return redirect()->route('obat.show')->with('success', 'Data Obat berhasil diupdate');
        }
    } catch (\Exception $e) {
        return redirect()->route('obat.edit', ['id' => $id])->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
}
}