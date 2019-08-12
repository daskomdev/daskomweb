<?php

namespace App\Http\Controllers;

use App\Temp_Jawabantp;
use Illuminate\Http\Request;

class TempJawabantpController extends Controller
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
        $allJawaban_id = "";
        for ($i=0; $i < count($request->all()); $i++) { 
          
            $temp_Jawabantp = Temp_Jawabantp::create([
                'praktikan_id'  => $request->input($i.'.praktikan_id'),
                'modul_id'      => $request->input($i.'.modul_id'),
                'soal_id'       => $request->input($i.'.soal_id'),
                'jawaban'       => $request->input($i.'.jawaban') == null ? 'empty' : $request->input($i.'.jawaban'),
            ]);    

            $allJawaban_id .= $temp_Jawabantp->id;

            if($i !== count($request->all())-1)
                $allJawaban_id .= '-';
        } 

        return response()->json([
            'message'=> 'success',
            'allJawaban_id' => $allJawaban_id,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Temp_Jawabantp  $temp_Jawabantp
     * @return \Illuminate\Http\Response
     */
    public function show(Temp_Jawabantp $temp_Jawabantp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Temp_Jawabantp  $temp_Jawabantp
     * @return \Illuminate\Http\Response
     */
    public function edit(Temp_Jawabantp $temp_Jawabantp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Temp_Jawabantp  $temp_Jawabantp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Temp_Jawabantp $temp_Jawabantp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Temp_Jawabantp  $temp_Jawabantp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Temp_Jawabantp $temp_Jawabantp)
    {
        //
    }
}
