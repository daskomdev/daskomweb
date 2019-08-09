<?php

namespace App\Http\Controllers;

use App\Praktikan;
use App\Jawaban_Fitb;
use App\Jawaban_Jurnal;
use App\Jawaban_Mandiri;
use App\Jawaban_Ta;
use App\Jawaban_Tk;
use App\Configuration;
use App\Laporan_Praktikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PraktikanController extends Controller
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
            'nama'          => 'required|unique:praktikans|unique:asistens|string',
            'nim'           => 'required|unique:praktikans|size:10|string',
            'password'      => 'required|min:6|string',
            'kelas_id'      => 'required|integer',
            'alamat'        => 'required|min:10|string',
            'nomor_telepon' => 'required|min:9|string',
            'email'         => 'required|email|unique:praktikans|string',
        ]);

        if(!Configuration::find(1)->registrationPraktikan_activation)
            return '{"message": "Registrasi untuk asisten telah ditutup"}';

        Praktikan::create([
            'nama'          => $request->nama,
            'nim'           => $request->nim,
            'password'      => Hash::make($request->password),
            'kelas_id'      => $request->kelas_id,
            'alamat'        => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'email'         => $request->email,
        ]);

        return '{"message": "success"}';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Praktikan  $praktikan
     * @return \Illuminate\Http\Response
     */
    public function show(Praktikan $praktikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Praktikan  $praktikan
     * @return \Illuminate\Http\Response
     */
    public function edit(Praktikan $praktikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Praktikan  $praktikan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Praktikan $praktikan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        foreach (explode("-", $request->allpraktikan_nim) as $nim => $value) {
                
            Jawaban_Fitb::where('praktikan_id', Praktikan::where('nim', $value)->first()->id)
                    ->where('modul_id', $request->modul_id)
                    ->delete();
            Jawaban_Jurnal::where('praktikan_id', Praktikan::where('nim', $value)->first()->id)
                    ->where('modul_id', $request->modul_id)
                    ->delete();
            Jawaban_Mandiri::where('praktikan_id', Praktikan::where('nim', $value)->first()->id)
                    ->where('modul_id', $request->modul_id)
                    ->delete();
            Jawaban_Ta::where('praktikan_id', Praktikan::where('nim', $value)->first()->id)
                    ->where('modul_id', $request->modul_id)
                    ->delete(); 
            Jawaban_Tk::where('praktikan_id', Praktikan::where('nim', $value)->first()->id)
                    ->where('modul_id', $request->modul_id)
                    ->delete();
            Laporan_Praktikan::where('praktikan_id', Praktikan::where('nim', $value)->first()->id)
                    ->where('modul_id', $request->modul_id)
                    ->delete();
        }
        
        return '{"message": "success"}';
    }
}
