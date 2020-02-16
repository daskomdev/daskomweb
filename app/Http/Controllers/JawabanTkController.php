<?php

namespace App\Http\Controllers;

use App\Jawaban_Tk;
use App\Soal_Tk;
use Illuminate\Http\Request;

class JawabanTkController extends Controller
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
        Jawaban_Tk::where('praktikan_id', $request->input('0.praktikan_id'))
                ->where('modul_id', $request->input('0.modul_id'))
                ->delete();
                 
        for ($i=0; $i < count($request->all()); $i++) { 
          
            Jawaban_Tk::create([
                'praktikan_id'  => $request->input($i.'.praktikan_id'),
                'modul_id'      => $request->input($i.'.modul_id'),
                'soal_id'       => $request->input($i.'.soal_id'),
                'jawaban'       => $request->input($i.'.jawaban') == '' ? '-' : $request->input($i.'.jawaban'),
            ]);    
        } 

        $allJawabanTk = Jawaban_Tk::where('praktikan_id', $request->input('0.praktikan_id'))
            ->where('modul_id', $request->input('0.modul_id'))
            ->get();

        $nilaiTkCorrect = 0;
        foreach ($allJawabanTk as $jawaban => $j) {
            $currentSoal = Soal_Tk::find($j->soal_id);
            if($j->jawaban == $currentSoal->jawaban_benar)
                $nilaiTkCorrect++;
        }

        $nilaiTk = $nilaiTkCorrect * /*Max Nilai*/100 / /*Max Soal*/10;

        return response()->json([
            'message' => 'success',
            'nilaiTk' => $nilaiTk,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jawaban_Tk  $jawaban_Tk
     * @return \Illuminate\Http\Response
     */
    public function show(Jawaban_Tk $jawaban_Tk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jawaban_Tk  $jawaban_Tk
     * @return \Illuminate\Http\Response
     */
    public function edit(Jawaban_Tk $jawaban_Tk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jawaban_Tk  $jawaban_Tk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jawaban_Tk $jawaban_Tk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jawaban_Tk  $jawaban_Tk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jawaban_Tk $jawaban_Tk)
    {
        //
    }
}
