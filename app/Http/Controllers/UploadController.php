<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UploadController extends Controller
{
    public function uploadFile(Request $request){
    	$orignalName = $request->tmpPic->getClientOriginalName();
    	$ext = $request->tmpPic->getClientOriginalExtension();
    	
    	$destinationPath = base_path() . '/public/uploads/images/user';
        if ($request->hasFile('tmpPic')) {
            $file = $request->file('tmpPic');
            $data['orignalName'] = $orignalName;
            $data['filename'] = $filename = str_random(10) .".". $ext;
            $file->move($destinationPath, $filename);
            $data['success'] = true;
        } else {
            $data['success'] = fale;
        }

        return response()->json($data);

    }
}
