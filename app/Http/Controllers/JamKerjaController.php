<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JamKerja;

class JamKerjaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['jamkerja'] = JamKerja::all();
        return view('jamkerja.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $masukjam    =   $request->masukjam.":".$request->masukmin;     
        $pulangjam   =   $request->pulangjam.":".$request->pulangmin;
        /*$request->validate([
            'ket'       =>  'required|min:3',
            'masuk'     =>  'required',
            'pulang'    =>  'required',
        ]);*/
        $jamkerja = new JamKerja();
        $jamkerja->ket              =       $request->ket;
        $jamkerja->waktu_masuk      =       $masukjam;
        $jamkerja->waktu_pulang     =       $pulangjam;
        $jamkerja->save();
        return redirect('jamkerja');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['jamkerja'] = JamKerja::find($id);
        return view('jamkerja.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'ket'             =>  'required|min:3',
            'waktu_masuk'     =>  'required',
            'waktu_pulang'    =>  'required',
        ]);
        $jamkerja                   =   JamKerja::find($id);
        $jamkerja->ket              =       $request->ket;
        $jamkerja->waktu_masuk      =       $request->waktu_masuk;
        $jamkerja->waktu_pulang     =       $request->waktu_pulang;
        $jamkerja->update();
        return redirect('jamkerja')->with('pesan', 'sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jamkerja = JamKerja::find($id);
        $jamkerja->delete();
        return redirect('jamkerja')->with('pesan', 'delete');
    }
}
