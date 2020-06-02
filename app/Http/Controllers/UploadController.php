<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Images; // Call/Import Images Model
use File; // call facades File

use RealRashid\SweetAlert\Facades\Alert;

class UploadController extends Controller
{
    public function upload(){
        $images = Images::get();
        return view('upload', ['images' => $images]);
    }

    public function proses_upload(Request $request){
        $this->validate($request, [
            'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'keterangan' => 'required'
        ]);

        // simpan data file yang di upload le variabel $file
        $file = $request->file('file');

        // format file name 
        $file_name = time()."_".$file->getClientOriginalName();

        // isi dengan nama folder tempat kemana file di upload
        $folder = 'data_file';
        $file->move($folder, $file_name);

        Images::create([
            'file' => $file_name,
            'keterangan' => $request->keterangan,
        ]);
        
        // SweetAlert::message('Robots are working!'); // testing swal di laravel
        toast('Uploaded successfully','success');
        
        return redirect()->back();
        
        // // nama file 
        // echo 'File Name: '.$file->getClientOriginalName();
        // echo '<br>';
        
        // // ekstensi file 
        // echo 'File Extension: '.$file->getClientOriginalExtension();
        // echo '<br>';
        
        // // real path 
        // echo 'File Real Path: '.$file->getRealPath();
        // echo '<br>';
        
        // // ukuran file => Returns the size of the file, in bytes
        // echo 'File Size: '.$file->getSize().' Bytes';
        // echo '<br>';
        // echo 'File Size: '.ceil($file->getSize() / 1000).' Kilo Bytes';
        // echo '<br>';
        
        // // tipe mime
        // echo 'File Mime Type: '.$file->getMimeType();
        // echo '<br>';
        
        // // upload file
        // $file->move($tujuan_upload, $file->getClientOriginalName());
        
    }

    public function delete(Request $request){

        $param_images_id = $request->images_id;

        // proses delete file
        $images = Images::where('id', $param_images_id)->first();
        File::delete('data_file'.$images->file);

        // proses delete data
        Images::where('id', $param_images_id)->delete();

        toast('Images has been deleted.','success');

        return redirect()->back();
    }
}
