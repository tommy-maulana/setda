<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jabatan;

class JabatanController extends Controller
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
        $data['jabatan'] = Jabatan::all();
        return view('jabatan.index',$data);
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
            'id_jbt'    =>  'required|unique:jabatan|min:3|max:5',
            'nama_jbt'  =>  'required|min:3',
        ]);
        $jabatan = new Jabatan();
        $jabatan->id_jbt     =       $request->id_jbt;
        $jabatan->nama_jbt   =       $request->nama_jbt;
        $jabatan->save();
        return redirect('jabatan');
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
        $data['jabatan'] = Jabatan::find($id);
        return view('jabatan.edit', $data);
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
            'nama_jbt'  =>  'required|min:3',
        ]);
        $jabatan = Jabatan::find($id);
        $jabatan->nama_jbt   =       $request->nama_jbt;
        $jabatan->update();
        return redirect('jabatan')->with('pesan', 'sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jabatan = Jabatan::find($id);
        $jabatan->delete();
        return redirect('jabatan')->with('pesan', 'delete');
    }
}
