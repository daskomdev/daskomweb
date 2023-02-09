<?php

namespace App\Http\Controllers;

use App\Nilai;
use App\Jawaban_Ta;
use App\Soal_Ta;
use App\Jawaban_Tk;
use App\Soal_Tk;
use App\Jawaban_Fitb;
use App\Jawaban_Jurnal;
use App\Jawaban_Mandiri;
use App\Jawaban_Tp;
use App\Praktikan;
use App\Asisten;
use App\Laporan_Praktikan;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($praktikan_id, $modul_id)
    {
        if($modul_id == 1){

            $nilaiTa = 100;
            $nilaiTk = 100;

        } else {

            $allJawabanTa = Jawaban_Ta::where('praktikan_id', $praktikan_id)
                ->where('modul_id', $modul_id)
                ->get();

            $nilaiTaCorrect = 0;
            foreach ($allJawabanTa as $jawaban => $j) {
                $currentSoal = Soal_Ta::find($j->soal_id);
                if($j->jawaban == $currentSoal->jawaban_benar)
                    $nilaiTaCorrect++;
            }

            $nilaiTa = $nilaiTaCorrect * /*Max Nilai*/100 / /*Max Soal*/10;

            $allJawabanTk = Jawaban_Tk::where('praktikan_id', $praktikan_id)
                ->where('modul_id', $modul_id)
                ->get();

            $nilaiTkCorrect = 0;
            foreach ($allJawabanTk as $jawaban => $j) {
                $currentSoal = Soal_Tk::find($j->soal_id);
                if($j->jawaban == $currentSoal->jawaban_benar)
                    $nilaiTkCorrect++;
            }

            $nilaiTk = $nilaiTkCorrect * /*Max Nilai*/100 / /*Max Soal*/10;
        }

        return response()->json([
            'message' => 'success',
            'nilaiTa' => $nilaiTa,
            'nilaiTk' => $nilaiTk,
        ], 200);
    }

    public function my_array_unique($array, $keep_key_assoc = false){
        $duplicate_keys = array();
        $tmp = array();       
    
        foreach ($array as $key => $val){
            // convert objects to arrays, in_array() does not support objects
            if (is_object($val))
                $val = (array)$val;
    
            if (!in_array($val, $tmp))
                $tmp[] = $val;
            else
                $duplicate_keys[] = $key;
        }
    
        foreach ($duplicate_keys as $key)
            unset($array[$key]);
    
        return $keep_key_assoc ? $array : array_values($array);
    }

    public function list($praktikan_id, $modul_id)
    {
        $allJawabanJurnal = [];

        $jawabans = Jawaban_Fitb::where('praktikan_id', $praktikan_id)
            ->where('jawaban__fitbs.modul_id', $modul_id)
            ->leftJoin('soal__fitbs', 'jawaban__fitbs.soal_id', '=', 'soal__fitbs.id')
            ->get();
            
        foreach ($jawabans as $jawaban => $value)
            array_push($allJawabanJurnal, $value);  
            
        $jawabans = Jawaban_Jurnal::where('praktikan_id', $praktikan_id)
            ->where('jawaban__jurnals.modul_id', $modul_id)
            ->leftJoin('soal__jurnals', 'jawaban__jurnals.soal_id', '=', 'soal__jurnals.id')
            ->get();
            
        foreach ($jawabans as $jawaban => $value)
            array_push($allJawabanJurnal, $value);  
            
        $jawabans = Jawaban_Mandiri::where('praktikan_id', $praktikan_id)
            ->where('jawaban__mandiris.modul_id', $modul_id)
            ->leftJoin('soal__mandiris', 'jawaban__mandiris.soal_id', '=', 'soal__mandiris.id')
            ->get();
            
        foreach ($jawabans as $jawaban => $value)
            array_push($allJawabanJurnal, $value);
    
        $allJawabanJurnal = $this->my_array_unique($allJawabanJurnal);
    
        if(Jawaban_Tp::where('praktikan_id', $praktikan_id)
            ->where('modul_id', $modul_id)
            ->exists()) {
            
            $allJawabanTp = [];
            $jawabans = Jawaban_Tp::where('praktikan_id', $praktikan_id)
                ->where('jawaban__tps.modul_id', $modul_id)
                ->leftJoin('soal__tps', 'jawaban__tps.soal_id', '=', 'soal__tps.id')
                ->get();
                
            foreach ($jawabans as $jawaban => $value)
                array_push($allJawabanTp, $value);
    
            $allJawabanTp = $this->my_array_unique($allJawabanTp);
    
        } else {
                $allJawabanTp = "nope";
        }
    
        return response()->json([
            'message' => 'success',
            'allJawabanTp' => $allJawabanTp,
            'allJawabanJurnal' => $allJawabanJurnal,
        ], 200);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Nilai::where('praktikan_id', $request->praktikan_id)
            ->where('modul_id', $request->modul_id)
            ->exists()) {
            
            $currentNilai = Nilai::where('praktikan_id', $request->praktikan_id)
                ->where('modul_id', $request->modul_id)->first();
            $currentNilai->tp = $request->tp;
            $currentNilai->ta = $request->ta;
            $currentNilai->tk = $request->tk;
            $currentNilai->jurnal = $request->jurnal;
            $currentNilai->skill = $request->skill;
            $currentNilai->diskon = $request->diskon;
            $currentNilai->rating = $request->rating;
            $currentNilai->save();

        } else {

            Nilai::create([
                'tp'  => $request->tp,
                'ta'  => $request->ta,
                'tk'  => $request->tk,
                'jurnal'  => $request->jurnal,
                'skill'  => $request->skill,
                'diskon'  => $request->diskon,
                'rating'  => $request->rating,
                'modul_id'  => $request->modul_id,
                'kelas_id'  => $request->kelas_id,
                'asisten_id'  => $request->asisten_id,
                'praktikan_id'  => $request->praktikan_id,
            ]);
        }

        return '{"message": "success"}';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function showAll($praktikan_id)
    {
        $allNilai = Nilai::where('praktikan_id', $praktikan_id)
            ->leftJoin('moduls', 'nilais.modul_id', '=', 'moduls.id')
            ->get();

        return response()->json([
            'message' => 'success',
            'allNilai' => $allNilai,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show($praktikan_id, $modul_id)
    {
        $currentNilai = Nilai::where('praktikan_id', $praktikan_id)
            ->where('modul_id', $modul_id)
            ->first();

        return response()->json([
            'message' => 'success',
            'nilai' => $currentNilai,
        ], 200);
    }

    public function edit($praktikan_nim, $asisten_id, $modul_id)
    {
        if(!Praktikan::where("nim", $praktikan_nim)->exists()) {

            return response()->json([
                'message' => 'Praktikan ini tidak ada dalam database',
            ], 200);
        }

        if(Laporan_Praktikan::where("praktikan_id", Praktikan::where("nim", $praktikan_nim)->first()->id)
            ->where("asisten_id", $asisten_id)
            ->where("modul_id", $modul_id)
            ->exists()) {

            return response()->json([
                'message' => 'Praktikan ini tidak perlu di set karena sudah masuk sesuai sistem',
            ], 200);
        }

        if(Laporan_Praktikan::where("praktikan_id", Praktikan::where("nim", $praktikan_nim)->first()->id)
            ->where("modul_id", $modul_id)
            ->exists()) {

            $currentLaporan = Laporan_Praktikan::where("praktikan_id", Praktikan::where("nim", $praktikan_nim)->first()->id)
                ->where("modul_id", $modul_id)->first();
            
            $currentLaporan->pesan = $currentLaporan->pesan." (set manual by ". Asisten::where('id', $asisten_id)->first()->kode .")";
            $currentLaporan->asisten_id = $asisten_id;
            $currentLaporan->save();

        } else {

            Laporan_Praktikan::create([
                'pesan'              => "set manual by ". Asisten::where('id', $asisten_id)->first()->kode,
                'modul_id'           => $modul_id,
                'praktikan_id'       => Praktikan::where("nim", $praktikan_nim)->first()->id,
                'asisten_id'         => $asisten_id,
                'rating_asisten'     => 5,
                'rating_praktikum'   => 5,
            ]);
        }

        return response()->json([
            'message' => 'success',
        ], 200);
    }
    public function showApi($praktikan_nim, $modul_id)
    {
        $id= Praktikan::where("nim",$praktikan_nim)->first()->id;
        $currentNilai = Nilai::where('praktikan_id', $id)
            ->where('modul_id', $modul_id)
            ->first();

        return response()->json([
            'message' => 'success',
            'nilai' => $currentNilai,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nilai $nilai)
    {
        //
    }
}
