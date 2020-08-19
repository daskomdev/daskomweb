<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload()
    {
        return view ('upload');
    }
    public function proses_upload(Request $request){
		$this->validate($request, [
			'file' => 'required|image',
		]);
 
		$file = $request->file('file');
 
      	        // nama file
		echo 'File Name: '.$file->getClientOriginalName();
		echo '<br> Uploaded! You can close this now..... just click outside the popup ';
 
      	        // upload destinaton:
		$tujuan_upload = 'assets';
 
                // upload file
		$file->move($tujuan_upload,$file->getClientOriginalName());
		
	}
}