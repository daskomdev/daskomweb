<?php

namespace App\Http\Controllers;

use App\History_Izin;
use App\Asisten;
use Illuminate\Http\Request;

class HistoryIzinController extends Controller
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
        if($request->allasisten_kode != ''){
            foreach (explode ("-", $request->allasisten_kode) as $kode => $value) {
                History_Izin::create([
                    'hari'        => $request->hari,
                    'shift'       => $request->shift,
                    'status'      => $request->status,
                    'asisten_id'  => Asisten::where('kode', $value)->first()->id,
                    'modul_id'    => $request->modul_id,
                ]); 
            }
        }

        return '{"message": "success"}';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\History_Izin  $history_Izin
     * @return \Illuminate\Http\Response
     */
    public function show(History_Izin $history_Izin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\History_Izin  $history_Izin
     * @return \Illuminate\Http\Response
     */
    public function edit(History_Izin $history_Izin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\History_Izin  $history_Izin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, History_Izin $history_Izin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\History_Izin  $history_Izin
     * @return \Illuminate\Http\Response
     */
    public function destroy(History_Izin $history_Izin)
    {
        //
    }
}
