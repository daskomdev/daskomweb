<?php

namespace App\Http\Controllers;

use App\Modul;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $modul = Modul::find($id);

        return response()->json([
            'message'=> 'success',
            'modul' => $modul,
        ], 200);
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
            'judul'     => 'required|unique:moduls|string',
            'deskripsi' => 'required|string',
            'isi'       => 'required|string',
            'isEnglish' => 'required',
            'isUnlocked'  => 'required',
        ]);

        Modul::create([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'isi'       => $request->isi,
            'isEnglish' => $request->isEnglish,
            'isUnlocked'  => $request->isUnlocked,
        ]);

        $id = Modul::where('judul', $request->judul)->first()->id;

        return '{"message": "success", "id": '. $id .'}';
    }

    public function show()
    {
        $allModul = Modul::all();
        return $allModul;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modul  $modul
     * @return \Illuminate\Http\Response
     */
    public function edit(Modul $modul)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string',
            'deskripsi'   => 'required|string',
            'isi'         => 'required|string',
            'isEnglish'   => 'required',
        ]);    

        if($request->judul != $request->oldJudul)
            foreach (Modul::all() as $modul => $value) 
                if($value->judul === $request->judul)
                    return '{"message": "Judul '. $request->judul .' sudah terdaftar"}';

        $modul = Modul::find($request->id);
        $modul->judul = $request->judul;
        $modul->deskripsi = $request->deskripsi;
        $modul->isi = $request->isi;
        $modul->isEnglish = $request->isEnglish;
        $modul->save();

        $modul->id = $request->id;
        $modul->judul = $request->judul;
        $modul->deskripsi = $request->deskripsi;
        $modul->isi = $request->isi;
        $modul->isEnglish = $request->isEnglish;

        return response()->json([
            'message'=> 'success',
            'modul' => $modul,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modul  $modul
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modul = Modul::find($id);
        $modul->delete();

        return '{"message": "success"}';
    }

    public function updateJawabanConfiguration(Request $request){
        $request->validate([
            'id'         => 'required',
            'idINT'         => 'required',
            'isUnlocked'   => 'required',
        ]);  

        $modul = Modul::where('id', $request->id)->first();
        $modul->isUnlocked = $request->isUnlocked;
        $modul->save();

        $modul = Modul::where('id', $request->idINT)->first();
        $modul->isUnlocked = $request->isUnlocked;
        $modul->save();

        return '{"message": "success"}';
    }
    
}
