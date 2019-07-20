<?php

namespace App\Http\Controllers;

use App\History_Piket;
use Illuminate\Http\Request;

class HistoryPiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        History_Piket::create([
            'hari'        => $request->hari,
            'shift'       => $request->shift,
            'status'      => $request->pj,
            'asisten_id'  => $request->asisten_id,
            'modul_id'    => $request->modul_id,
        ]);

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\History_Piket  $history_Piket
     * @return \Illuminate\Http\Response
     */
    public function show(History_Piket $history_Piket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\History_Piket  $history_Piket
     * @return \Illuminate\Http\Response
     */
    public function edit(History_Piket $history_Piket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\History_Piket  $history_Piket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, History_Piket $history_Piket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\History_Piket  $history_Piket
     * @return \Illuminate\Http\Response
     */
    public function destroy(History_Piket $history_Piket)
    {
        //
    }
}
