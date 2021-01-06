<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use App\Departemen;
use App\Jabatan;
use App\StatusKaryawan;
use App\ViewKaryawan;
use App\StatusAbsen;
use App\StatusKehadiran;
use App\DataRawAbsensi;
use App\AbsenTidakMasuk;
use App\JamKerja;

class KaryawanController extends Controller
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
        $data['karyawan']       = \DB::table('view_data_karyawan')->get();
        $data['df_jabatan']     = Jabatan::pluck('nama_jbt','id_jbt');
        $data['df_departemen']  = Departemen::pluck('nama_dpt','id_dpt');
        return view('karyawan.index',$data);
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
            'id_kry'    =>  'required|unique:karyawan|min:1',
            'nama_kry'  =>  'required|min:3',
            'id_dpt'    =>  'required|min:3',
            'id_jbt'    =>  'required|min:3',
        ]);
        $karyawan = new Karyawan();
        $karyawan->id_kry     =       $request->id_kry;
        $karyawan->nama_kry   =       $request->nama_kry;
        $karyawan->id_dpt     =       $request->id_dpt;
        $karyawan->id_jbt     =       $request->id_jbt;
        $karyawan->save();
        return redirect('karyawan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dataabsen()
    {
        $data['karyawan']       = \DB::table('view_data_karyawan')->get();
        $data['df_jabatan']     = Jabatan::pluck('nama_jbt','id_jbt');
        $data['df_departemen']  = Departemen::pluck('nama_dpt','id_dpt');
        return view('karyawan.dataabsen',$data);
    }
    public function show($id)
    {
        $data['absen']          = \DB::table('view_absen_kry as a')
                                        ->selectRaw('a.*, b.wkt_msk, b.wkt_plg')
                                        ->leftJoin(\DB::raw("(select tgl,
                                                                    wkt_msk,
                                                                    wkt_plg 
                                                            from kalender 
                                                            WHERE status = '0')as b"), function($join)
                                                            {
                                                                $join->on("a.tanggal","=","b.tgl");
                                                            })
                                        ->where('id_kry',$id)
                                        ->orderby('tanggal')
                                        ->get();
        $data['normal']         = JamKerja::first();
        /*$data['absen']          = \DB::table('view_absen_kry')
                                        ->where('id_kry',$id)
                                        ->orderby('tanggal')
                                        ->get();*/
        $data['nama']           = ViewKaryawan::find($id);
        $data['st_izin']        = StatusKehadiran::pluck('status','id');
        $data['id_kry']         = $id;
        return view('karyawan.detailabsen',$data);
        //return $data['normal']->waktu_masuk;
    }

    public function iptabsen($id_kry,$tanggal,$status)
    {
        $data['id_kry']         = $id_kry;
        $data['tanggal']        = $tanggal;
        $data['stat']           = $status;
        $data['st_absen']       = StatusAbsen::pluck('status_absen','kd_absen');
        return view('karyawan.iptabsen',$data);
    }

    public function sviptabsen(Request $request, $id_kry)
    {
        $request->validate([
            'masukjam'    =>  'required|min:2|max:2',
            'masukmin'    =>  'required|min:2|max:2'
        ]);
        $id_kry = $id_kry;
        $tgl    = $request->tgl;
        $jam    = $request->masukjam.':'.$request->masukmin;
        $sta    = $request->status;
        $date   = date_format(date_create($tgl.' '.$jam),'Y-m-d H:i:s');
        
        $karyawan = new DataRawAbsensi();
        $karyawan->id_kry       =       $id_kry;
        $karyawan->tgl          =       $date;
        $karyawan->kd_absen     =       $request->status;
        $karyawan->save();
        return redirect('karyawan/'.$id_kry)->with('pesan', 'sukses');

    }
    
    public function iptizin(Request $request,$id_kry)
    {
        $tgl_mulai      = date_format(date_create(substr($request->tgl,1,10)), 'Y-m-d');
        $tgl_selesai    = date_format(date_create(substr($request->tgl,-10,10)), 'Y-m-d');
        $date1          = date_create($tgl_mulai);
        $date2          = date_create($tgl_selesai);
        $status         = $request->status;
        //repeat date-range
        while($date1<=$date2){
            
            $absen = new AbsenTidakMasuk();
            $absen->id_kry          =       $id_kry;
            $absen->tgl             =       $date1;
            $absen->kd_status       =       $status;
            $absen->save(); 

            $date1->modify('+1 day'); 
        }
        return redirect('karyawan/'.$id_kry)->with('pesan', 'sukses');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['karyawan']       = Karyawan::find($id);
        $data['df_status']      = StatusKaryawan::pluck('status','id');
        $data['df_jabatan']     = Jabatan::pluck('nama_jbt','id_jbt');
        $data['df_departemen']  = Departemen::pluck('nama_dpt','id_dpt');
        return view('karyawan.edit', $data);
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
            'nama_kry'  =>  'required|min:3',
            'id_dpt'    =>  'required',
            'id_jbt'    =>  'required',
        ]);
        $karyawan = Karyawan::find($id);
        $karyawan->nama_kry     =       $request->nama_kry;
        $karyawan->id_dpt       =       $request->id_dpt;
        $karyawan->id_jbt       =       $request->id_jbt;
        $karyawan->status       =       $request->status;
        $karyawan->update();
        return redirect('karyawan')->with('pesan', 'sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$karyawan = karyawan::find($id);
        //$karyawan->delete();
        //return redirect('karyawan')->with('pesan', 'delete');
    }
}
