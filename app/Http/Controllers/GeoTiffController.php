<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;
use PhpTiff\Reader\TiffReader;

class GeoTiffController extends Controller
{
    public function getGeoTiffValues(Request $request)
{
    $lat = $request->query('lat');
    $lon = $request->query('lon');

    try {
        $response = Http::get("http://127.0.0.1:5000/extract", [
            'lat' => $lat,
            'lon' => $lon
        ]);

        if ($response->successful()) {
            $data = $response->json();

            // Cek jika semua nilai null
            if (is_null($data['ndvi']) && is_null($data['ndwi']) && is_null($data['dsm']) && is_null($data['rainfall'])) {
                return response()->json(['error' => 'Semua data bernilai null'], 500);
            }

            return response()->json($data);
        }

        return response()->json(['error' => 'Gagal mendapatkan respons dari API.'], 500);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Gagal terhubung ke API Python: ' . $e->getMessage()], 500);
    }
}


public function fetch(Request $request)
{
    $lat = $request->lat;
    $lng = $request->lng;

    try {
        $response = Http::get('http://127.0.0.1:5000/extract', [
            'lat' => $lat,
            'lon' => $lng
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Gagal mengambil data dari Flask'], 500);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
    }
}
}
