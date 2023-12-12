<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Patient;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreatePatientController extends Controller
{
    public function create (){
    return view ('asisten.create_pasien');
    }

    public function store(Request $request)
{
    // Validate the request...

    $patient = new Patient;

        //     $patient->name = $request->name;

    $patient->name = $request->name;
    $patient->gender = $request->gender;
    $patient->wali = $request->wali;
    $patient->phone_number = $request->phone_number;
    $patient->address = $request->address;
    $patient->tanggal_lahir = $request->tanggal_lahir;

    // Construct the request payload
    $payload = [
        'name' => $patient->name,
        'gender' => $patient->gender,
        'wali' => $patient->wali,
        'phone_number' => $patient->phone_number,
        'address' => $patient->address,
        'tanggal_lahir' => $patient->tanggal_lahir,
    ];

    $client = new Client();
    $url = "http://127.0.0.1:8000/api/patient";
    $response = $client->request('POST', $url, [
        'headers' => ['Content-type' => 'application/json'],
        'body' => json_encode($payload)
    ]);

    $content = $response->getBody()->getContents();
    $contentArray = json_decode($content, true);
    if($contentArray['status']!= true){
        echo "Gagal tambah pasien";
    }else{
        return redirect()->back()->with('success','Berhasil memasukkan data');
    }

    // You might want to handle the response or redirect accordingly
}


    // public function show()
    // {
    //     $data = Patient::whereNull('deleted_at')->paginate(5);
    
    //     // Menghitung umur dan mengubah format tanggal lahir pada semua objek pasien
    //     $data->map(function ($patient) {
    //         $birthdate = Carbon::parse($patient->tanggal_lahir);
    //         $age = $birthdate->diffInYears(Carbon::now());
    //         $patient->umur = $age;
    //         $patient->tanggal_lahir = $birthdate->isoFormat('D MMMM YYYY');
    //         return $patient;
    //     });
    
    //     return view('asisten.show_pasien', ['data' => $data]);
    // }

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

    return view('asisten.show_pasien', ['data' => $data]);
}

    // public function gone($id){
    //     $data = Patient::findOrFail($id);
    
    //     $data->delete();
    
    //     return redirect()->back()->with('success', 'Data Pasien berhasil dihapus.');
    // }

    // public function edit(Patient $patient){
    //     return view('asisten.edit_pasien', ['patient' => $patient])->with('success', 'Data Pasien berhasil diedit');
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
                return view('asisten.edit_pasien', ['patient' => $patient]);
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
            return redirect()->route('patients.edit', ['id' => $id])->withErrors(['error' => 'Gagal mengambil data pasien']);
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
            return redirect()->route('patients.edit', ['id' => $id])->withErrors(['error' => 'Gagal update pasien: ' . $contentArrayUpdate['message']]);
        } else {
            return redirect()->route('patients.show')->with('success', 'Data Pasien berhasil diupdate');
        }
    } catch (\Exception $e) {
        return redirect()->route('patients.edit', ['id' => $id])->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
}

    
}