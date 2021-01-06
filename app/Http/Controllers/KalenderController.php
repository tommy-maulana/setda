<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KalenderKerja;
use App\Kalender;
use App\JamKerja;
class KalenderController extends Controller
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
        //$data['kalender']   =   \DB::table('view_kalender_kerja')->get();
        //$data['jamkrj']     =   JamKerja::pluck('ket','id');
        //return view('kalender.index', $data);
        $tanggal = Kalender::all();
        return view('kalender.kal', compact('tanggal'));
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
        $tgl_mulai = date_create(substr($request->tgl,1,10));
        $tgl_selesai = date_create(substr($request->tgl,-10,10));
        $desc   = $request->keg;
        $status = $request->ket;
        if($status == '0')
        {
            $msk    =   $request->wkt_msk;
            $plg    =   $request->wkt_plg;
        }
        else
        {
            $msk    =   null;
            $plg    =   null;
        }
        /*
        $jamkerja = new KalenderKerja();
        $jamkerja->nama_kegiatan        =       $request->keg;
        $jamkerja->tgl_mulai            =       $tgl_mulai;
        $jamkerja->tgl_selesai          =       $tgl_selesai;
        $jamkerja->id_jam               =       $request->jam_krj;
        $jamkerja->status               =       $request->ket;
        $jamkerja->save();*/
        
        $data['ket']    = 0;
        while($tgl_mulai <= $tgl_selesai)
        {
            $kal            =   new Kalender();
            $kal->deskrip   =   $desc;
            $kal->tgl       =   date_format($tgl_mulai,'Y-m-d');
            $kal->wkt_msk   =   $msk;
            $kal->wkt_plg   =   $plg;
            $kal->status    =   $status;
            $kal->save();

            // increase tgl_mulai by 1 
            $tgl_mulai->modify('+1 day'); 
        }
        return redirect('kalender');
        //return $data;
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
        $data['kal']        =   Kalender::find($id);
        return view('kalender.edit', $data);
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
        $tgl    = date_create($request->tgl);
        $desc   = $request->deskrip;
        $status = $request->status;
        if($status == '0')
        {
            $msk    =   $request->wkt_msk;
            $plg    =   $request->wkt_plg;
        }
        else
        {
            $msk    =   null;
            $plg    =   null;
        }
            $kal            =   Kalender::find($id);
            $kal->deskrip   =   $desc;
            $kal->tgl       =   date_format($tgl,'Y-m-d');
            $kal->wkt_msk   =   $msk;
            $kal->wkt_plg   =   $plg;
            $kal->status    =   $status;
            $kal->update();
        return redirect('kalender')->with('pesan', 'sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kal = Kalender::find($id);
        $kal->delete();
        return redirect('kalender')->with('pesan', 'delete');
    }
}
