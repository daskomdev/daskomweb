<?php

namespace App\Http\Controllers;

use App\Jadwal_Jaga;
use App\Kelas;
use App\Asisten;
use Illuminate\Http\Request;

class JadwalJagaController extends Controller
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
            'kelas_id'   => 'required',
            'asisten_id' => 'required',
        ]);
        
        foreach (Jadwal_Jaga::all() as $modul => $value) 
            if($value->kelas_id == $request->kelas_id &&
                $value->asisten_id == $request->asisten_id){

            return '{"message": "Asisten '. 
                        Asisten::find($request->asisten_id)->kode .
                    ' sudah ada dalam kelas '. 
                        Kelas::find($request->kelas_id)->kelas .
                    '"}';   
        }
         
        Jadwal_Jaga::create([
            'kelas_id'     => $request->kelas_id,
            'asisten_id'   => $request->asisten_id,
        ]);

        $id = Jadwal_Jaga::where('kelas_id', $request->kelas_id)
                ->where('asisten_id', $request->asisten_id)->first()->id;

        return '{"message": "success", "id": '. $id .'}';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jadwal_Jaga  $jadwal_Jaga
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal_Jaga $jadwal_Jaga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jadwal_Jaga  $jadwal_Jaga
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal_Jaga $jadwal_Jaga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jadwal_Jaga  $jadwal_Jaga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal_Jaga $jadwal_Jaga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jadwal_Jaga  $jadwal_Jaga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $plotting = Jadwal_Jaga::where('asisten_id', $request->asisten_id)
                        ->where('kelas_id', $request->kelas_id)->first();

        if($plotting == null)
            return '{"message": "Kombinasi asisten & kelas tidak ditemukan"}';

        $plotting->delete();

        return '{"message": "success"}';
    }
}
