<?php

namespace App\Http\Controllers;

use App\Praktikum;
use App\Kelas;
use App\Modul;
use Illuminate\Http\Request;

class PraktikumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //THIS IS TO CHECK FOR PRAKTIKUM HISTORY EXISTENCE
        if(Praktikum::where("modul_id", $request->modul_id)
            ->where("kelas_id", $request->kelas_id)
            ->exists())
            return response()->json([
                'message'=> 'Praktikum modul "'. 
                            Modul::where("id", $request->modul_id)->first()->judul .
                            '" pada kelas '. Kelas::where("id", $request->kelas_id)->first()->kelas .' sudah SELESAI',
            ], 200);

        return '{"message": "success"}';
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
        Praktikum::create([
            'modul_id'    => $request->modul_id,
            'kelas_id'    => $request->kelas_id,
            'pj_id'       => $request->pj_id,
            'laporan_id'  => $request->laporan_id,
        ]); 

        return '{"message": "success"}';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Praktikum  $praktikum
     * @return \Illuminate\Http\Response
     */
    public function show(Praktikum $praktikum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Praktikum  $praktikum
     * @return \Illuminate\Http\Response
     */
    public function edit(Praktikum $praktikum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Praktikum  $praktikum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Praktikum $praktikum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Praktikum  $praktikum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Praktikum $praktikum)
    {
        //
    }
}
