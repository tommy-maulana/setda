<?php

namespace App\Http\Controllers;
use App\UpdateMesin;
use App\DataRawAbsensi;
use App\Imports\AbsenImport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function downloadattlogindex()
    {
        $data['datamesin'] = \DB::table('view_last_update_absen')->get();
        return view('upload.downattlog', $data);
    }

    function importattlog(Request $request)
    {
        $this->validate($request, [
			'file' => 'required|mimes:xls,xlsx'
        ]);
        
        //$insert_data = Excel::toArray(new AbsenImport, request()->file('file'));  
        Excel::import(new AbsenImport, request()->file('file'));  
        
        // Redirect to index
        return redirect('/downattlog')->with('pesan', 'upload');
        //return $insert_data;
    }

    function uploadnama ()
    {
        $data['datamesin'] = \DB::table('view_update_mesin')->get();
        return view('upload.uploadnama',$data);
        //$data['jlh'] = \DB::table('karyawan')->count();
        //return $data;
        
    }

    function updatenama(Request $request)
    {
        $id     =   $request->id; 
        $ip     =   $request->ip; 
        $port   =   $request->port; 
        $key    =   $request->key; 
        $tgl    =   $request->tgl; 
        $buffer =   true;
        //function upload to mesin
        /*$data['kry'] = \DB::table('karyawan')->get();
        foreach ($data['kry'] as $row)
        {
            $id_kry     =   $row->id_kry;
            $nama_kry   =   $row->nama_kry;
            $buffer     =   UploadNamaKry($ip, $key, $id_kry, $nama_kry);
        }*/

        if(!$buffer)
        {
            return redirect('/uploadnama');
        }
        else
        {
            if($tgl==null)
            {
                $upt = new UpdateMesin();
                $upt->id_mesin      =   $id;
                $upt->tgl_update    =   date('Y-m-d H:i:s');
                $upt->timestamps    =   false;
                $upt->save();
                return redirect('/uploadnama')->with('pesan', 'upload');
            }
            else
            {
                $upt = UpdateMesin::find($id);
                $upt->tgl_update    =   date('Y-m-d H:i:s');
                $upt->timestamps    =   false;
                $upt->update();
                return redirect('/uploadnama')->with('pesan', 'upload');
            }
        }
        
    }

    function downloadattlog(Request $request)
    {
        $id     =   $request->id; 
        $ip     =   $request->ip; 
        $port   =   $request->port; 
        $key    =   $request->key; 
        $tgl    =   $request->tgl;
        
        //function download att log
        $abs        =   TarikDataAbsen($ip,$key,$port);         
        $ins        =   DB::table('data_raw_absensi')->insert($abs);
        if($ins)
        {
            if($tgl==null)
            {
                $upt = new UpdateMesin();
                $upt->id_mesin      =   $id;
                $upt->tgl_update    =   date('Y-m-d H:i:s');
                $upt->timestamps    =   false;
                $upt->save();
                return redirect('/downattlog')->with('pesan', 'upload');
            }
            else
            {
                $upt = UpdateMesin::find($id);
                $upt->tgl_update    =   date('Y-m-d H:i:s');
                $upt->timestamps    =   false;
                $upt->update();
                return redirect('/downattlog')->with('pesan', 'upload');
            }
        }
        
        return $ins;
    }
}
