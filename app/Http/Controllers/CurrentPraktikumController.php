<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Current_Praktikum;
use App\Events\praktikumStatusUpdated;
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

        $praktikum = Current_Praktikum::create([
            'asisten_id' => $request->asisten_id,
            'kelas_id'   => $request->kelas_id,
            'modul_id'   => $request->modul_id,
            'status'     => 0,
        ]);

        broadcast(new praktikumStatusUpdated($praktikum));

        return '{"message": "success"}';
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return response()->json([
            'message' => 'success',
            'current_praktikum' => Current_Praktikum::all()->first(),
        ], 200);
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

        broadcast(new praktikumStatusUpdated($praktikum));

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

        $praktikum = new Object;
        $praktikum->status = 777; //lucky but nooo, cause praktikum just deleted :v
        broadcast(new praktikumStatusUpdated($praktikum));
    }
}
