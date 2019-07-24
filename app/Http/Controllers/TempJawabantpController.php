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
        Temp_Jawabantp::create([
            'soal_id' => $request->soal_id,
            'jawaban' => $request->jawaban,
        ]);

        $id = Temp_Jawabantp::where('jawaban', $request->jawaban)
            ->where('soal_id', $request->soal_id)
            ->first()->id;

        return '{"message": "success", "id": '. $id .'}';
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
