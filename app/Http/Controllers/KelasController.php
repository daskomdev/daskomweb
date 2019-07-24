<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Asisten;
use App\Jadwal_Jaga;
use App\Praktikan;
use Inertia\Inertia;
use Illuminate\Http\Request;

class KelasController extends Controller
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
            'kelas'  => 'required|unique:kelas|size:8|string',
            'hari'   => 'required|string',
            'shift'  => 'required|size:1|string',
        ]);

        $allKelas = Kelas::all();
        foreach ($allKelas as $kelas => $value) {
            if($value->hari == $request->hari &&
                $value->shift == $request->shift)
                return '{"message": "Terdapat kelas '. strtoupper($value->kelas) .' pada hari '. strtoupper($request->hari) .' shift '. $request->shift .'"}';
        }

        Kelas::create([
            'kelas'  => strtoupper($request->kelas),
            'hari'   => strtoupper($request->hari),
            'shift'  => $request->shift,
        ]);

        $id = Kelas::where('kelas', $request->kelas)->first()->id;

        return '{"message": "success", "id": '. $id .'}';
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($kelas_id)
    {
         
        $all_jadwal = Jadwal_Jaga::where('kelas_id', $kelas_id)->get();

        $all_asisten = [];
        foreach ($all_jadwal as $jadwal => $value) {
            $all_asisten[] = Asisten::where('id', $value->asisten_id)->first();
        }
        $all_praktikan = Praktikan::where('kelas_id', $kelas_id)->get();

        return response()->json([
            'message' => 'success',
            'all_asisten' => $all_asisten,
            'all_praktikan' => $all_praktikan,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'kelas'  => 'required|size:8|string',
            'hari'   => 'required|string',
            'shift'  => 'required|size:1|string',
        ]);

        if($request->oldKelas == null)
            return '{"message": "Pilih salah satu kelas yang ingin di edit terlebih dahulu"}';

        foreach (Kelas::all() as $kelas => $value) {
            if($value->kelas == $request->kelas &&
                $request->kelas != $request->oldKelas)
                return '{"message": "Kelas '. $request->kelas .' sudah terdaftar"}';
            if($value->hari == strtoupper($request->hari) &&
                $value->shift == strtoupper($request->shift))
                return '{"message": "Hari '. strtoupper($request->hari) .' shift '. $request->shift .' sudah terdaftar"}';
        }    
        
        $kelas = Kelas::where('kelas', $request->oldKelas)->first();

        if($kelas == null)
            return '{"message": "Kelas '. $request->oldKelas .' tidak ditemukan"}';

        $kelas->kelas = strtoupper($request->kelas);
        $kelas->hari = strtoupper($request->hari);
        $kelas->shift = $request->shift;
        $kelas->save();

        $kelas->id = $request->id;
        $kelas->kelas = strtoupper($request->kelas);
        $kelas->hari = strtoupper($request->hari);
        $kelas->shift = $request->shift;

        return response()->json([
            'message'=> 'success',
            'kelas' => $kelas,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $kelas = Kelas::where('kelas', $request->kelas)->first();
        $kelas->delete();

        return '{"message": "success"}';
    }
}
