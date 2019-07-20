<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Current_Praktikum;
use Illuminate\Http\Request;

class CurrentPraktikumController extends Controller
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
        DB::table('current__praktikums')->truncate();

        Current_Praktikum::create([
            'asisten_id' => $request->asisten_id,
            'kelas_id'   => $request->kelas_id,
            'status'     => 0,
        ]);

        return '{"message": "success"}';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Current_Praktikum  $current_Praktikum
     * @return \Illuminate\Http\Response
     */
    public function show(Current_Praktikum $current_Praktikum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Current_Praktikum  $current_Praktikum
     * @return \Illuminate\Http\Response
     */
    public function edit(Current_Praktikum $current_Praktikum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Current_Praktikum  $current_Praktikum
     * @return \Illuminate\Http\Response
     */
    public function update($status)
    {
        $praktikum = Current_Praktikum::all()->first();
        $praktikum->status = $status;
        $praktikum->save();

        return '{"message": "success"}';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        DB::table('current__praktikums')->truncate();
    }
}
