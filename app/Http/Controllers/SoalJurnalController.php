<?php

namespace App\Http\Controllers;

use App\Soal_Jurnal;
use App\Temp_Soaljurnal;
use Illuminate\Http\Request;

class SoalJurnalController extends Controller
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
            'soal'        => 'required|unique:soal__jurnals|string',
            'modul_id'    => 'required',
        ]);

        Soal_Jurnal::create([
            'soal'        => $request->soal,
            'modul_id'    => $request->modul_id,
        ]);

        $id = Soal_Jurnal::where('soal', $request->soal)->first()->id;

        return '{"message": "success", "id": '. $id .'}';
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRunmod()
    {
        $all_soalJurnalID = explode ("-", Temp_Soaljurnal::latest()->first()->allJurnal_id);
        foreach ($all_soalJurnalID as $soalId) {
            $all_soal[] = Soal_Jurnal::find($soalId);
        }
        return response()->json([
            'message'=> 'success',
            'all_soal' => $all_soal,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $all_soalJurnalID = explode ("-", Temp_Soaljurnal::latest()->first()->allJurnal_id);
        foreach ($all_soalJurnalID as $soalId) {
            $all_soal[] = Soal_Jurnal::find($soalId);
        }
        return response()->json([
            'message'=> 'success',
            'all_soal' => $all_soal,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Soal_Jurnal  $soal_Jurnal
     * @return \Illuminate\Http\Response
     */
    public function edit(Soal_Jurnal $soal_Jurnal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Soal_Jurnal  $soal_Jurnal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'soal'        => 'required|string',
            'modul_id'    => 'required',
        ]);

        if($request->soal != $request->oldSoal)
            foreach (Soal_Jurnal::all() as $soal => $value) 
                if($value->soal === $request->soal)
                    return '{"message": "Soal '. $request->soal .' sudah terdaftar"}';

        $soal = Soal_Jurnal::find($request->id);
        $soal->soal = $request->soal;
        $soal->modul_id = $request->modul_id;
        $soal->save();

        $soal->id = $request->id;
        $soal->soal = $request->soal;
        $soal->modul_id = $request->modul_id;

        return response()->json([
            'message'=> 'success',
            'soal' => $soal,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Soal_Jurnal  $soal_Jurnal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soal_Jurnal $soal_Jurnal)
    {
        //
    }
}
