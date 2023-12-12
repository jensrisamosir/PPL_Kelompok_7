<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Obat;
use App\Models\Patient;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class ShowPasienController extends Controller
{
    
    public function show()
{
    $client = new Client();
    $url = "http://127.0.0.1:8000/api/patient";
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

    return view('dokter.show_pasien', ['data' => $data]);
}

    // public function show2(Request $request) {
    //     $filter = $request->input('filter');
    
    //     if ($filter == 'habis') {
    //         $data = Obat::where('jumlah', 0)->whereNull('deleted_at')->paginate(5);
    //     } elseif ($filter == 'tersedia') {
    //         $data = Obat::where('jumlah', '>', 0)->whereNull('deleted_at')->paginate(5);
    //     } else {
    //         $data = Obat::whereNull('deleted_at')->paginate(5);
    //     }
    
    //     return view('dokter.show_obat', ['data' => $data, 'filter' => $filter]);
    // }

    public function show2(Request $request)
{
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

    return view('dokter.show_obat', ['data' => $data, 'filter' => $filter]);
}

    
    // public function gone($id){
    //     $data = Patient::findOrFail($id);
    
    //     $data->delete();
    
    //     return redirect()->back()->with('success', 'Data Pasien berhasil dihapus.');
    // }

    

    // public function edit(Patient $patient){
    //     return view('dokter.edit_pasien', ['patient' => $patient])->with ('success', 'Data Pasien berhasil diedit');
        
    // }

    // public function update (Request $request , Patient $patient){
    //     // $patient->id = $request->id;
    //     $patient->name = $request->name;
    //     $patient->tanggal_lahir = $request->tanggal_lahir;
    //     $patient->gender = $request->gender;
    //     $patient->phone_number= $request->phone_number;
    //     $patient->address = $request->address;
    //     $patient->update();
        
    //     return redirect()->route('patients.show.dokter');

    // }

    public function edit(string $id)
    {
        try {
            $client = new Client();
            $url = "http://127.0.0.1:8000/api/patient/$id";
            $response = $client->request('GET', $url);
            $content = $response->getBody()->getContents();
            $contentArray = json_decode($content, true);

            if ($contentArray['status'] !== true) {
                return redirect()->back()->withErrors(['error' => 'Gagal mengambil data pasien']);
            } else {
                $patient = $contentArray['data'];
                return view('dokter.edit_pasien', ['patient' => $patient]);
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            Log::error("Gagal melakukan permintaan ke server: " . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Gagal melakukan permintaan ke server: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            Log::error("Terjadi kesalahan: " . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, string $id)
{
    try {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/patient/$id";

        // Get the existing patient data
        $response = $client->request('GET', $url);
        $contentArray = json_decode($response->getBody()->getContents(), true);

        if ($contentArray['status'] !== true) {
            return redirect()->route('dokter.patients.edit', ['id' => $id])->withErrors(['error' => 'Gagal mengambil data pasien']);
        }

        // Merge existing data with the updated data
        $patient = $contentArray['data'];
        $updatedData = array_merge($patient, $request->all());

        // Update patient data
        $urlUpdate = "http://127.0.0.1:8000/api/patient/$id";
        $responseUpdate = $client->request('PUT', $urlUpdate, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($updatedData)
        ]);

        $contentArrayUpdate = json_decode($responseUpdate->getBody()->getContents(), true);

        if ($contentArrayUpdate['status'] !== true) {
            return redirect()->route('dokter.patients.edit', ['id' => $id])->withErrors(['error' => 'Gagal update pasien: ' . $contentArrayUpdate['message']]);
        } else {
            return redirect()->route('patients.show.dokter')->with('success', 'Data Pasien berhasil diupdate');
        }
    } catch (\Exception $e) {
        return redirect()->route('dokter.patients.edit', ['id' => $id])->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
}


    // public function show3(){
    //     $medical = DB::select('CALL view_create_medical');
        
    //     $data = Patient::all(); // mengambil semua data

    //     return view('dokter.show_pasien', ['data' => $data, 'medical' => $medical]);
    // }


}
