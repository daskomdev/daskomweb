<?php

namespace App\Http\Controllers;

use App\Tugaspendahuluan;
use Illuminate\Http\Request;

class TugaspendahuluanController extends Controller
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
            'modul_id'       => 'required',
            'pembahasan'     => 'required',
        ]);

        if(Tugaspendahuluan::where('modul_id', $request->modul_id)->exists()){
          
            $tp = Tugaspendahuluan::where('modul_id', $request->modul_id)->first();
            $tp->pembahasan = $request->pembahasan;
            $tp->save();
        } else
            $tp = Tugaspendahuluan::create([
                'modul_id'       => $request->modul_id,
                'pembahasan'     => $request->pembahasan,
            ]);

        return '{"message": "success", "id": '. $tp->id .'}';
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($modul_id)
    {
        if(Tugaspendahuluan::where('isActive', 1)->exists()){
            $tp = Tugaspendahuluan::where('isActive', 1)->first();
            $tp->isActive = 0;
            $tp->save();
        }

        $tp = Tugaspendahuluan::where('modul_id', $modul_id)->first();
        $tp->isActive = 1;
        $tp->save();

        return '{"message": "success"}';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tugaspendahuluan  $tugaspendahuluan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tugaspendahuluan $tugaspendahuluan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tugaspendahuluan  $tugaspendahuluan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tugaspendahuluan $tugaspendahuluan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($modul_id)
    {
        $tp = Tugaspendahuluan::where('modul_id', $modul_id)->first();
        $tp->isActive = 0;
        $tp->save();

        return '{"message": "success"}';
    }
}
