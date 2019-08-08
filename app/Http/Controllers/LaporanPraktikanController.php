<?php

namespace App\Http\Controllers;

use App\Laporan_Praktikan;
use Illuminate\Http\Request;

class LaporanPraktikanController extends Controller
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
            'pesan'            => 'required',
            'modul_id'         => 'required',
            'praktikan_id'     => 'required',
            'asisten_id'       => 'required',
            'rating_asisten'   => 'required',
            'rating_praktikum' => 'required',
        ]);

        if(Laporan_Praktikan::where('praktikan_id', $request->praktikan_id)
            ->where('modul_id', $request->modul_id)
            ->exists())
            return '{"message": "Kamu sudah pernah membuat laporan ini sebelumnya"}';

        Laporan_Praktikan::create([
            'pesan'              => $request->pesan,
            'modul_id'           => $request->modul_id,
            'praktikan_id'       => $request->praktikan_id,
            'asisten_id'         => $request->asisten_id,
            'rating_asisten'     => $request->rating_asisten,
            'rating_praktikum'   => $request->rating_praktikum,
        ]);

        return '{"message": "success"}';
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($praktikan_id, $modul_id)
    {
        if(Laporan_Praktikan::where('praktikan_id', $praktikan_id)
            ->where('modul_id', $modul_id)
            ->exists())
            return '{"message": "done"}';
        else
            return '{"message": "nope"}';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Laporan_Praktikan  $laporan_Praktikan
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporan_Praktikan $laporan_Praktikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laporan_Praktikan  $laporan_Praktikan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporan_Praktikan $laporan_Praktikan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laporan_Praktikan  $laporan_Praktikan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan_Praktikan $laporan_Praktikan)
    {
        //
    }
}
