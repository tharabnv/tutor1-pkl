<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Industri;

class ApiIndustriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $industri =  Industri::get();
        return response()->json($industri, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $industri = new Industri();
        $industri->nama = $request->nama;
        $industri->bidang_usaha = $request->bidang_usaha;
        $industri->alamat = $request->alamat;
        $industri->kontak = $request->kontak;
        $industri->email = $request->email;
        $industri->website = $request->website;
        $industri->save();
        return response()->json($industri,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $industri = Industri::find($id);
        return response()->json($industri,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $industri = Industri::find($id);
        $industri->nama = $request->nama;
        $industri->bidang_usaha = $request->bidang_usaha;
        $industri->alamat = $request->alamat;
        $industri->kontak = $request->kontak;
        $industri->email = $request->email;
        $industri->website = $request->website;
        $industri->save();
        return response()->json($industri,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Industri::destroy($id);
        return response()->json(["message"=>"Data berhasil terhapus"], 200);
    }
}