<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;

class DepartemenController extends Controller
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
        $data['departemen'] = Departemen::all();
        return view('departemen.index',$data);
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
            'id_dpt'    =>  'required|unique:departemen|min:3|max:4',
            'nama_dpt'  =>  'required|min:3',
        ]);
        $departemen = new Departemen();
        $departemen->id_dpt     =       $request->id_dpt;
        $departemen->nama_dpt   =       $request->nama_dpt;
        $departemen->save();
        return redirect('departemen');
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
        $data['departemen'] = Departemen::find($id);
        return view('departemen.edit', $data);
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
            'nama_dpt'  =>  'required|min:3',
        ]);
        $departemen = Departemen::find($id);
        $departemen->nama_dpt   =       $request->nama_dpt;
        $departemen->update();
        return redirect('departemen')->with('pesan', 'sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departemen = Departemen::find($id);
        $departemen->delete();
        return redirect('departemen')->with('pesan', 'delete');
    }
}
