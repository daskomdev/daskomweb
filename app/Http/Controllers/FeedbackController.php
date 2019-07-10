<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;
use App\Asisten;

class FeedbackController extends Controller
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
            'kode'  => 'required|size:3|string',
            'pesan' => 'required|string',
        ]);

        $asisten = Asisten::where('kode', strtoupper($request->kode))->first();

        if($asisten != null)
            Feedback::create([
                'asisten_id'    => $asisten->id,
                'nama_praktikan'=> $request->nama_praktikan,
                'pesan'         => $request->pesan,
                'kelas_id'      => $request->kelas_id,
            ]);
        else return '{"message": "Asisten '. $request->kode .' tidak ditemukan"}';

        return '{"message": "success"}';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
