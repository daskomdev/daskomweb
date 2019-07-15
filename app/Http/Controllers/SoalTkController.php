<?php

namespace App\Http\Controllers;

use App\Soal_Tk;
use Illuminate\Http\Request;

class SoalTkController extends Controller
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
            'pertanyaan'       => 'required|unique:soal__tks|string',
            'modul_id'         => 'required',
            'jawaban_benar'    => 'required',
            'jawaban_salah1'   => 'required',
            'jawaban_salah2'   => 'required',
            'jawaban_salah3'   => 'required',
        ]);

        if($request->jawaban_benar == $request->jawaban_salah1 ||
            $request->jawaban_benar == $request->jawaban_salah2 ||
            $request->jawaban_benar == $request->jawaban_salah3 ||
            $request->jawaban_salah1 == $request->jawaban_salah2 ||
            $request->jawaban_salah1 == $request->jawaban_salah3 ||
            $request->jawaban_salah2 == $request->jawaban_salah3 ) {

            return '{"message": "Tidak boleh ada jawaban yang sama"}';
        }

        Soal_Tk::create([
            'pertanyaan'       => $request->pertanyaan,
            'modul_id'         => $request->modul_id,
            'jawaban_benar'    => $request->jawaban_benar,
            'jawaban_salah1'   => $request->jawaban_salah1,
            'jawaban_salah2'   => $request->jawaban_salah2,
            'jawaban_salah3'   => $request->jawaban_salah3,
        ]);

        $id = Soal_Tk::where('pertanyaan', $request->pertanyaan)->first()->id;

        return '{"message": "success", "id": '. $id .'}';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Soal_Tk  $soal_Tk
     * @return \Illuminate\Http\Response
     */
    public function show(Soal_Tk $soal_Tk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Soal_Tk  $soal_Tk
     * @return \Illuminate\Http\Response
     */
    public function edit(Soal_Tk $soal_Tk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Soal_Tk  $soal_Tk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'pertanyaan'       => 'required|string',
            'modul_id'         => 'required',
            'jawaban_benar'    => 'required|string',
            'jawaban_salah1'   => 'required|string',
            'jawaban_salah2'   => 'required|string',
            'jawaban_salah3'   => 'required|string',
        ]);

        if($request->pertanyaan != $request->oldPertanyaan)
            foreach (Soal_Tk::all() as $soal => $value) 
                if($value->pertanyaan == $request->pertanyaan)
                    return '{"message": "Soal '. $request->pertanyaan .' sudah terdaftar"}';

        $soal = Soal_Tk::find($request->id);
        $soal->pertanyaan = $request->pertanyaan;
        $soal->jawaban_benar = $request->jawaban_benar;
        $soal->jawaban_salah1 = $request->jawaban_salah1;
        $soal->jawaban_salah2 = $request->jawaban_salah2;
        $soal->jawaban_salah3 = $request->jawaban_salah3;
        $soal->modul_id = $request->modul_id;
        $soal->save();

        $soal->id = $request->id;
        $soal->pertanyaan = $request->pertanyaan;
        $soal->jawaban_benar = $request->jawaban_benar;
        $soal->jawaban_salah1 = $request->jawaban_salah1;
        $soal->jawaban_salah2 = $request->jawaban_salah2;
        $soal->jawaban_salah3 = $request->jawaban_salah3;
        $soal->modul_id = $request->modul_id;

        return response()->json([
            'message'=> 'success',
            'soal' => $soal,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Soal_Tk  $soal_Tk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soal_Tk $soal_Tk)
    {
        //
    }
}
