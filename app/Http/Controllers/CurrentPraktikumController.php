<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Current_Praktikum;
use App\Soal_Jurnal;
use App\Soal_Fitb;
use App\Temp_Soaljurnal;
use App\Events\praktikumStatusUpdated;
use Illuminate\Http\Request;

class CurrentPraktikumController extends Controller
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
        DB::table('current__praktikums')->truncate();

        $praktikum = Current_Praktikum::create([
            'asisten_id' => $request->asisten_id,
            'kelas_id'   => $request->kelas_id,
            'modul_id'   => $request->modul_id,
            'status'     => 0,
        ]);

        $all_soalJurnal = Soal_Jurnal::where('modul_id', $request->modul_id)->inRandomOrder()->take(2)->get();
        $all_soalFitb = Soal_Fitb::where('modul_id', $request->modul_id)->inRandomOrder()->take(1)->get();
        
        $all_soalJurnalID = '';
        for ($i=0; $i < count($all_soalJurnal); $i++) { 
            $all_soalJurnalID .= $all_soalJurnal[$i]->id;
            if($i !== count($all_soalJurnal)-1)
                $all_soalJurnalID .= '-';
        }

        $all_soalFitbID = '';
        for ($i=0; $i < count($all_soalFitb); $i++) { 
            $all_soalFitbID .= $all_soalFitb[$i]->id;
            if($i !== count($all_soalFitb)-1)
                $all_soalFitbID .= '-';
        }
        Temp_Soaljurnal::create([
            'allJurnal_id' => $all_soalJurnalID,
            'allFitb_id' => $all_soalFitbID,
        ]);

        broadcast(new praktikumStatusUpdated($praktikum));

        return '{"message": "success"}';
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return response()->json([
            'message' => 'success',
            'current_praktikum' => Current_Praktikum::all()->first(),
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Current_Praktikum  $current_Praktikum
     * @return \Illuminate\Http\Response
     */
    public function edit(Current_Praktikum $current_Praktikum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Current_Praktikum  $current_Praktikum
     * @return \Illuminate\Http\Response
     */
    public function update($status)
    {
        $praktikum = Current_Praktikum::all()->first();
        $praktikum->status = $status;
        $praktikum->save();

        broadcast(new praktikumStatusUpdated($praktikum));

        return '{"message": "success"}';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $praktikum = Current_Praktikum::all()->first();
        $praktikum->status = 777; //lucky but nooo, cause praktikum just deleted :v
        $praktikum->save();
        broadcast(new praktikumStatusUpdated($praktikum));

        DB::table('current__praktikums')->truncate();
    }
}
