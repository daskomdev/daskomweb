<?php

namespace App\Http\Controllers;

use App\Tugaspendahuluan;
use App\Modul;
use Illuminate\Http\Request;

class TugaspendahuluanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($isEnglish)
    {
        $tp = null;

        if(Tugaspendahuluan::where('isActive', true)->exists()) {
            if($isEnglish === 'true') {
                $allTP = Tugaspendahuluan::where('isActive', true)->get();
                foreach ($allTP as $tp => $value) {
                    if(Modul::where('id', $value->modul_id)->first()->isEnglish){
                        $tp = Tugaspendahuluan::where('modul_id', $value->modul_id)->first();
                        $tp->pembahasan = Modul::where('id', $value->modul_id)->first()->isi;

                        return response()->json([
                            'message'=> 'success',
                            'tp' => $tp,
                        ], 200);
                    }
                }
            
            } else {

                $allTP = Tugaspendahuluan::where('isActive', true)->get();
                foreach ($allTP as $tp => $value) {
                    if(!Modul::where('id', $value->modul_id)->first()->isEnglish){
                        $tp = Tugaspendahuluan::where('modul_id', $value->modul_id)->first();
                        $tp->pembahasan = Modul::where('id', $value->modul_id)->first()->isi;
                    
                        return response()->json([
                            'message'=> 'success',
                            'tp' => $tp,
                        ], 200);
                    }
                }
            }
        }
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

            if(Modul::where('id', $modul_id)->first()->isEnglish){
                $allTP = Tugaspendahuluan::where('isActive', 1)->get();
                foreach ($allTP as $TP => $value) {
                    if(Modul::where('id', $value->modul_id)->first()->isEnglish) {

                        $tp = $value;
                        $tp->isActive = 0;
                        $tp->save();
                    }
                }

            } else {

                $allTP = Tugaspendahuluan::where('isActive', 1)->get();
                foreach ($allTP as $TP => $value) {
                    if(!Modul::where('id', $value->modul_id)->first()->isEnglish) {

                        $tp = $value;
                        $tp->isActive = 0;
                        $tp->save();
                    }
                }
            }
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
