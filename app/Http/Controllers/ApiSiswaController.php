<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class ApiSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::get();
        return response()->json($siswa, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $siswa = new Siswa();
        $siswa->nama = $request->nama;
        $siswa->nis = $request->nis;
        $siswa->gender = $request->gender;
        $siswa->alamat = $request->alamat;
        $siswa->kontak = $request->kontak;
        $siswa->email = $request->email;
        $siswa->status_pkl = $request->status_pkl;
        $siswa->foto = $request->foto; 
        $siswa->save(); 
        return response()->json($siswa, 200);      
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = Siswa::find($id);
        return response()->json($siswa, 200);      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $siswa = Siswa::find($id);
        $siswa->nama = $request->nama;
        $siswa->nis = $request->nis;
        $siswa->gender = $request->gender;
        $siswa->alamat = $request->alamat;
        $siswa->kontak = $request->kontak;
        $siswa->email = $request->email;
        $siswa->status_pkl = $request->status_pkl;
        $siswa->foto = $request->foto; 
        $siswa->save(); 
        return response()->json($siswa, 200);      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Siswa::destroy($id);
        return response()->json(["message"=>"Data berhasil terhapus"], 200);      

    }
}