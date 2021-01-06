<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MesinFinger;

class MesinController extends Controller
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
        $data['mesin']  = MesinFinger::all();
        return view('mesin.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$data = UploadNamaKry('192.168.1.204','0','77777', 'albert');
        $data = TarikDataFinger('192.168.100.7','0','654654');
        
        return $data;
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
            'nama_mesin'    =>  'required',
            'ip_mesin'      =>  'required',
            'port'          =>  'required|max:4',
            'comkey'        =>  'required|max:8',
        ]);
        $mesin = new MesinFinger();
        $mesin->nama_mesin       =       $request->nama_mesin;
        $mesin->ip_mesin         =       $request->ip_mesin;
        $mesin->port             =       $request->port;
        $mesin->comkey           =       $request->comkey;
        $mesin->save();
        return redirect('mesin');
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
        $data['mesin']       = MesinFinger::find($id);
        return view('mesin.edit', $data);
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
            'nama_mesin'    =>  'required',
            'ip_mesin'      =>  'required',
            'port'          =>  'required|max:4',
            'comkey'        =>  'required|max:8',
        ]);
        $mesin = MesinFinger::find($id);
        $mesin->nama_mesin       =       $request->nama_mesin;
        $mesin->ip_mesin         =       $request->ip_mesin;
        $mesin->port             =       $request->port;
        $mesin->comkey           =       $request->comkey;
        $mesin->update();
        return redirect('mesin')->with('pesan', 'sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mesin = MesinFinger::find($id);
        $mesin->delete();
        return redirect('mesin')->with('pesan', 'delete');
    }

}
