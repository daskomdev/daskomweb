<?php

namespace App\Http\Controllers;

use App\Asisten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AsistenController extends Controller
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
            'nama'      => 'required|unique:asistens|unique:praktikans|string',
            'kode'      => 'required|unique:asistens|size:3|string',
            'password'  => 'required|min:6|string',
            'role_id'   => 'required|integer',
            'deskripsi' => 'required|min:10|string',
        ]);

        Asisten::create([
            'nama'      => $request->nama,
            'kode'      => $request->kode,
            'password'  => Hash::make($request->password),
            'role_id'   => $request->role_id,
            'deskripsi' => $request->deskripsi,
        ]);

        return '{"message": "success"}';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asisten  $asisten
     * @return \Illuminate\Http\Response
     */
    public function show(Asisten $asisten)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asisten  $asisten
     * @return \Illuminate\Http\Response
     */
    public function edit(Asisten $asisten)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asisten  $asisten
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asisten $asisten)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asisten  $asisten
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asisten $asisten)
    {
        //
    }
}
