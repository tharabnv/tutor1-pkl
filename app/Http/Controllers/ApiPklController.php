<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pkl; // 1. penggunaaan model pkl

class ApiPklController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 2. method untuk merespon permintaan baca data pkl

        $pkl = Pkl::get();
        return response()->json($pkl, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 3. method untuk merespon permintaan create data pkl baru

        $pkl = new Pkl();
        $pkl->siswa_id = $request->siswa_id;
        $pkl->industri_id = $request->industri_id;
        $pkl->guru_id = $request->guru_id;
        $pkl->mulai = $request->mulai;
        $pkl->selesai = $request->selesai;
        $pkl->save();
        return response()->json($pkl, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // 4. method untuk respon proses baca data salah satu pkl

        $pkl = Pkl::find($id);
        return response()->json($pkl, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 5. method untuk respon update data pkl

        $pkl = Pkl::find($id);
        $pkl->siswa_id = $request->siswa_id;
        $pkl->industri_id = $request->industri_id;
        $pkl->guru_id = $request->guru_id;
        $pkl->mulai = $request->mulai;
        $pkl->selesai = $request->selesai;
        $pkl->save();
        return response()->json($pkl, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 6. method untuk respon proses hapus data pkl

        Pkl::destroy($id);
        return response()->json(["message"=>"behasil terhapus"], 200);
    }
}