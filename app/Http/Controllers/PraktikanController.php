<?php

namespace App\Http\Controllers;

use App\Praktikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PraktikanController extends Controller
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
            'nama'          => 'required|unique:praktikans|unique:asistens|string',
            'nim'           => 'required|unique:praktikans|size:10|string',
            'password'      => 'required|min:6|string',
            'kelas_id'      => 'required|integer',
            'alamat'        => 'required|min:10|string',
            'nomor_telepon' => 'required|min:9|string',
            'email'         => 'required|email|unique:praktikans|string',
        ]);

        Praktikan::create([
            'nama'          => $request->nama,
            'nim'           => $request->nim,
            'password'      => Hash::make($request->password),
            'kelas_id'      => $request->kelas_id,
            'alamat'        => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'email'         => $request->email,
        ]);

        return '{"message": "success"}';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Praktikan  $praktikan
     * @return \Illuminate\Http\Response
     */
    public function show(Praktikan $praktikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Praktikan  $praktikan
     * @return \Illuminate\Http\Response
     */
    public function edit(Praktikan $praktikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Praktikan  $praktikan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Praktikan $praktikan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Praktikan  $praktikan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Praktikan $praktikan)
    {
        //
    }
}
