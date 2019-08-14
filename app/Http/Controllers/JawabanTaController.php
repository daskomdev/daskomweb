<?php

namespace App\Http\Controllers;

use App\Jawaban_Ta;
use Illuminate\Http\Request;

class JawabanTaController extends Controller
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
        Jawaban_Ta::where('praktikan_id', $request->input('0.praktikan_id'))
                ->where('modul_id', $request->input('0.modul_id'))
                ->delete(); 

        for ($i=0; $i < count($request->all()); $i++) { 
          
            Jawaban_Ta::create([
                'praktikan_id'  => $request->input($i.'.praktikan_id'),
                'modul_id'      => $request->input($i.'.modul_id'),
                'soal_id'       => $request->input($i.'.soal_id'),
                'jawaban'       => $request->input($i.'.jawaban') == '' ? '-' : $request->input($i.'.jawaban'),
            ]);    
        } 

        return '{"message": "success"}';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jawaban_Ta  $jawaban_Ta
     * @return \Illuminate\Http\Response
     */
    public function show(Jawaban_Ta $jawaban_Ta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jawaban_Ta  $jawaban_Ta
     * @return \Illuminate\Http\Response
     */
    public function edit(Jawaban_Ta $jawaban_Ta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jawaban_Ta  $jawaban_Ta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jawaban_Ta $jawaban_Ta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jawaban_Ta  $jawaban_Ta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jawaban_Ta $jawaban_Ta)
    {
        //
    }
}
