<?php

namespace App\Http\Controllers;


use App\Jawaban_Fitb;
use App\Jawaban_Jurnal;
use App\Jawaban_Mandiri;

class PraktikanLihatJawabanController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
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
    
    public function __invoke($praktikan_id, $modul_id)
    {
        $allJawabanJurnal = [];

        $jawabans = Jawaban_Fitb::where('praktikan_id', $praktikan_id)
            ->where('jawaban__fitbs.modul_id', $modul_id)
            ->leftJoin('soal__fitbs', 'jawaban__fitbs.soal_id', '=', 'soal__fitbs.id')
            ->join('moduls', 'jawaban__fitbs.modul_id', '=', 'moduls.id')
            ->where('moduls.isUnlocked', 1)
            ->select('jawaban__fitbs.jawaban', 'soal__fitbs.soal')
            ->get();
            
        foreach ($jawabans as $jawaban => $value)
            array_push($allJawabanJurnal, $value);  
            
        $jawabans = Jawaban_Jurnal::where('praktikan_id', $praktikan_id)
            ->where('jawaban__jurnals.modul_id', $modul_id)
            ->leftJoin('soal__jurnals', 'jawaban__jurnals.soal_id', '=', 'soal__jurnals.id')
            ->join('moduls', 'jawaban__jurnals.modul_id', '=', 'moduls.id')
            ->where('moduls.isUnlocked', 1)
            ->select('jawaban__jurnals.jawaban', 'soal__jurnals.soal')
            ->get();
            
        foreach ($jawabans as $jawaban => $value)
            array_push($allJawabanJurnal, $value);  
            
        $jawabans = Jawaban_Mandiri::where('praktikan_id', $praktikan_id)
            ->where('jawaban__mandiris.modul_id', $modul_id)
            ->leftJoin('soal__mandiris', 'jawaban__mandiris.soal_id', '=', 'soal__mandiris.id')
            ->join('moduls', 'jawaban__mandiris.modul_id', '=', 'moduls.id')
            ->where('moduls.isUnlocked', 1)
            ->select('jawaban__mandiris.jawaban', 'soal__mandiris.soal')
            ->get();
            
        foreach ($jawabans as $jawaban => $value)
            array_push($allJawabanJurnal, $value);

        $allJawabanJurnal = $this->my_array_unique($allJawabanJurnal);

        return response()->json([
            'message' => 'success',
            'allJawabanJurnal' => $allJawabanJurnal,
        ], 200);
    }
}
