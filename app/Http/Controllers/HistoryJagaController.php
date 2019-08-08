<?php

namespace App\Http\Controllers;

use App\History_Jaga;
use App\Asisten;
use Illuminate\Http\Request;

class HistoryJagaController extends Controller
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
        if($request->asisten_id != null)
            History_Jaga::create([
                'hari'          => $request->hari,
                'shift'         => $request->shift,
                'pj'            => $request->pj,
                'modul_id'      => $request->modul_id,
                'asisten_id'    => $request->asisten_id,
            ]);
        else {
            foreach (explode("-", $request->allasisten_kode) as $kode => $value) {
                
                History_Jaga::create([
                    'hari'          => $request->hari,
                    'shift'         => $request->shift,
                    'pj'            => $request->pj,
                    'modul_id'      => $request->modul_id,
                    'asisten_id'    => Asisten::where('kode', $value)->first()->id,
                ]); 
            }
        }

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
            'latestPJHistory' => History_Jaga::where('pj', 1)->orderBy('created_at', 'desc')->first(),
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\History_Jaga  $history_Jaga
     * @return \Illuminate\Http\Response
     */
    public function edit(History_Jaga $history_Jaga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\History_Jaga  $history_Jaga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, History_Jaga $history_Jaga)
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
        $praktikum = History_Jaga::where('hari', $request->hari)
                ->where('shift', $request->shift)
                ->where('pj', $request->pj)
                ->where('modul_id', $request->modul_id)
                ->where('asisten_id', $request->asisten_id)
                ->first();
        $praktikum->delete();

        return '{"message": "success"}';
    }
}
