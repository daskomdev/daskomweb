<?php

namespace App\Http\Controllers;

use App\Asisten;
use App\Configuration;
use App\Laporan_Praktikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AsistenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|unique:asistens|unique:praktikans|string',
            'kode'      => 'required|unique:asistens|size:3|string',
            'password'  => 'required|min:6|string',
            'role_id'   => 'required|integer',
            'deskripsi' => 'required|min:10|string',
        ]);

        if(!Configuration::find(1)->registrationAsisten_activation)
            return '{"message": "Registrasi untuk asisten telah ditutup"}';

        Asisten::create([
            'nama'      => $request->nama,
            'kode'      => strtoupper($request->kode),
            'password'  => Hash::make($request->password),
            'role_id'   => $request->role_id,
            'deskripsi' => $request->deskripsi,
        ]);

        return '{"message": "success"}';
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($asisten_id)
    {
        $allAsistenData = Laporan_Praktikan::where('asisten_id', $asisten_id)->get();
        
        $ratingAsisten = 0;
        $gajiAsisten = 0;
        foreach ($allAsistenData as $key => $value) {
            $ratingAsisten += $value->rating_asisten;    
        }

        if(count($allAsistenData) !== 0){

            $ratingAsisten /= count($allAsistenData);
            $gajiAsisten = count($allAsistenData) * 25000;
            $gajiAsisten -= ($gajiAsisten * 0.01);
        }

        return response()->json([
            'message'=> 'success',
            'ratingAsisten' => $ratingAsisten,
            'gajiAsisten' => $gajiAsisten,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asisten  $asisten
     * @return \Illuminate\Http\Response
     */
    public function edit(Asisten $asisten)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asisten  $asisten
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asisten $asisten)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asisten  $asisten
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asisten $asisten)
    {
        //
    }
}
