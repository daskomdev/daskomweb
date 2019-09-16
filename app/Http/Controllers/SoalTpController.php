<?php

namespace App\Http\Controllers;

use App\Soal_Tp;
use App\Modul;
use App\Configuration;
use App\Tugaspendahuluan;
use Illuminate\Http\Request;

class SoalTpController extends Controller
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
            'soal'        => 'required|unique:soal__tps|string',
            'isEssay'     => 'required',
            'isProgram'   => 'required',
            'modul_id'    => 'required',
        ]);

        Soal_Tp::create([
            'soal'        => $request->soal,
            'isEssay'     => $request->isEssay,
            'isProgram'   => $request->isProgram,
            'modul_id'    => $request->modul_id,
        ]);

        $id = Soal_Tp::where('soal', $request->soal)->first()->id;

        return '{"message": "success", "id": '. $id .'}';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Soal_Tp  $soal_Tp
     * @return \Illuminate\Http\Response
     */
    public function show($isEnglish)
    {
        if(!Configuration::find(1)->tp_activation)
            return '{"message": "nope"}';

        if($isEnglish === 'true') {
            $allTP = Tugaspendahuluan::where('isActive', true)->get();
            foreach ($allTP as $tp => $value) {
                if(Modul::where('id', $value->modul_id)->first()->isEnglish){
                    $all_soalEssay = Soal_Tp::where('modul_id', $value->modul_id)
                                ->where('isEssay', true)
                                ->inRandomOrder()->take(5)->get();
                    $all_soalProgram = Soal_Tp::where('modul_id', $value->modul_id)
                                ->where('isProgram', true)
                                ->inRandomOrder()->take(3)->get();

                    return response()->json([
                        'message'=> 'success',
                        'all_soalEssay' => $all_soalEssay,
                        'all_soalProgram' => $all_soalProgram,
                    ], 200);
                }
            }

        } else {

            $allTP = Tugaspendahuluan::where('isActive', true)->get();
            foreach ($allTP as $tp => $value) { 
                if(!Modul::where('id', $value->modul_id)->first()->isEnglish){
                    $all_soalEssay = Soal_Tp::where('modul_id', $value->modul_id)
                                ->where('isEssay', true)
                                ->inRandomOrder()->take(5)->get();
                    $all_soalProgram = Soal_Tp::where('modul_id', $value->modul_id)
                                ->where('isProgram', true)
                                ->inRandomOrder()->take(3)->get();

                    return response()->json([
                        'message'=> 'success',
                        'all_soalEssay' => $all_soalEssay,
                        'all_soalProgram' => $all_soalProgram,
                    ], 200);
                }
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Soal_Tp  $soal_Tp
     * @return \Illuminate\Http\Response
     */
    public function edit(Soal_Tp $soal_Tp)
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
            'soal'       => 'required|string',
            'isEssay'    => 'required',
            'isProgram'  => 'required',
            'modul_id'   => 'required',
        ]);    

        if($request->soal != $request->oldSoal)
            foreach (Soal_Tp::all() as $soal => $value) 
                if($value->soal === $request->soal)
                    return '{"message": "Soal '. $request->soal .' sudah terdaftar"}';

        $soal = Soal_Tp::find($request->id);
        $soal->soal = $request->soal;

        if($request->jenisSoal === "essay"){
            $soal->isEssay = 1;
            $soal->isProgram = 0;
        } else if($request->jenisSoal === "program"){
            $soal->isEssay = 0;
            $soal->isProgram = 1;
        }
        $soal->modul_id = $request->modul_id;
        $soal->save();

        $soal->id = $request->id;
        $soal->soal = $request->soal;
        if($request->jenisSoal === "essay"){
            $soal->isEssay = 1;
            $soal->isProgram = 0;
        } else if($request->jenisSoal === "program"){
            $soal->isEssay = 0;
            $soal->isProgram = 1;
        }
        $soal->modul_id = $request->modul_id;

        return response()->json([
            'message'=> 'success',
            'soal' => $soal,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $soal = Soal_Tp::find($id);
        $soal->delete();

        return '{"message": "success"}';
    }
}
