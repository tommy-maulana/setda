<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\LaporanAkhir;
use PDF;

class LaporanController extends Controller
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
        $data['df_departemen']  = Departemen::pluck('nama_dpt','id_dpt');
        $data['lap']    = LaporanAkhir::orderBy('periode')->get();
        return view('laporan.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tgl1   =   '2020-03-01';
        $tgl2   =   '2020-03-31';
        //$data['peg']    = 
        $d=cal_days_in_month(CAL_GREGORIAN,$request->bln,$request->thn);
        
    }
    public function coba(Request $request)
    {
        $dpt                    = Departemen::find($request->id_dpt);
        $d                      = cal_days_in_month(CAL_GREGORIAN,$request->bln,$request->thn);
        $tgl1                   = date_create($request->thn.'-'.$request->bln.'-01');
        $tgl2                   = date_create($request->thn.'-'.$request->bln.'-'.$d);
        //$periode                = date_format($tgl1, 'F Y');
        $periode                = date_format(date_create($request->thn.'-'.$request->bln.'-01'), 'F Y');
        $date                   = weekendcount($tgl1,$tgl2);
        $libur                  = \DB::table('kalender')
                                        ->whereRaw("date_part('month',tgl) = $request->bln 
                                                    AND date_part('year',tgl) = $request->thn")
                                        ->where('status','=','1')
                                        ->count();

        $data['workday']        = $date['Workday']-$libur;
        $data['weekend']        = $date['Weekend']+$libur;

        $data['id_dpt']         = $dpt->id_dpt;
        $data['departemen']     = $dpt->nama_dpt;
        $data['bln']            = $request->bln;
        $data['thn']            = $request->thn;
        $data['periode']        = $periode;
        $data['absen']          = \DB::table('view_data_karyawan AS a')
                                        ->selectRaw('a. status, a.id_kry, a.nama_kry, a.nama_dpt, a.nama_jbt')
                                        ->selectRaw('b.absen, b.izin, b.sakit, b.cuti, b.dl')
                                        ->selectRaw('c.t, c.e, c.s, c.l')
                                        ->leftJoin(\DB::raw("(select id_kry, 
                                                            count(*) filter (where status IS null) as absen,
                                                            count(*) filter (where status = 'Izin') as izin,
                                                            count(*) filter (where status = 'Sakit') as sakit,
                                                            count(*) filter (where status = 'Cuti') as cuti,
                                                            count(*) filter (where status = 'Dinas Luar') as dl 
                                                            from view_absen_kry 
                                                            WHERE date_part('month',tanggal) = $request->bln 
                                                            AND date_part('year',tanggal) = $request->thn
                                                            group by id_kry)as b"), function($join)
                                                            {
                                                                $join->on("a.id_kry","=","b.id_kry");
                                                            })
                                        ->leftJoin(\DB::raw("(select id_kry,
                                                            count(tlmbt) filter (where tlmbt BETWEEN 1 AND 30) as t,
                                                            count(tlmbt) filter (where tlmbt BETWEEN 31 AND 60) as e,
                                                            count(tlmbt) filter (where tlmbt BETWEEN 61 AND 90) as s,
                                                            count(tlmbt) filter (where tlmbt >90) as l
                                                            from view_terlambat 
                                                            WHERE date_part('month',tanggal) = $request->bln 
                                                            AND date_part('year',tanggal) = $request->thn
                                                            group by id_kry)as c"), function($join)
                                                            {
                                                                $join->on("a.id_kry","=","c.id_kry");
                                                            })
                                        ->where('nama_dpt',$dpt->nama_dpt)
                                        ->get();
        $data['jlh_peg']        = $data['absen']->count();
        //return redirect('laporan')->with('pesan', 'sukses');
        //return $data['absen'];
        return view('laporan.show', $data);
        
    }
    
    public function test(Request $request)
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $date = date('m');
        return $date;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cetak_pdf($id_dpt,$bln,$thn)
    {
        $dpt                    = Departemen::find($id_dpt);
        $d                      = cal_days_in_month(CAL_GREGORIAN,$bln,$thn);
        $tgl1                   = date_create($thn.'-'.$bln.'-01');
        $tgl2                   = date_create($thn.'-'.$bln.'-'.$d);
        $periode                = date_format($tgl1, 'F Y');
        $date                   = weekendcount($tgl1,$tgl2);
        $libur                  = \DB::table('kalender')
                                        ->whereRaw("date_part('month',tgl) = $bln 
                                                    AND date_part('year',tgl) = $thn")
                                        ->where('status','=','1')
                                        ->count();

        $data['workday']        = $date['Workday']-$libur;
        $data['weekend']        = $date['Weekend']+$libur;

        $data['departemen']     = $dpt->nama_dpt;
        $data['periode']        = $periode;
        $data['absen']          = \DB::table('view_data_karyawan AS a')
                                        ->selectRaw('a. status, a.id_kry, a.nama_kry, a.nama_dpt, a.nama_jbt')
                                        ->selectRaw('b.absen, b.izin, b.sakit, b.cuti, b.dl')
                                        ->selectRaw('c.t, c.e, c.s, c.l')
                                        ->leftJoin(\DB::raw("(select id_kry, 
                                                            count(*) filter (where status IS null) as absen,
                                                            count(*) filter (where status = 'Izin') as izin,
                                                            count(*) filter (where status = 'Sakit') as sakit,
                                                            count(*) filter (where status = 'Cuti') as cuti,
                                                            count(*) filter (where status = 'Dinas Luar') as dl 
                                                            from view_absen_kry 
                                                            WHERE date_part('month',tanggal) = $bln 
                                                            AND date_part('year',tanggal) = $thn
                                                            group by id_kry)as b"), function($join)
                                                            {
                                                                $join->on("a.id_kry","=","b.id_kry");
                                                            })
                                        ->leftJoin(\DB::raw("(select id_kry,
                                                            count(tlmbt) filter (where tlmbt BETWEEN 1 AND 30) as t,
                                                            count(tlmbt) filter (where tlmbt BETWEEN 31 AND 60) as e,
                                                            count(tlmbt) filter (where tlmbt BETWEEN 61 AND 90) as s,
                                                            count(tlmbt) filter (where tlmbt >90) as l
                                                            from view_terlambat 
                                                            WHERE date_part('month',tanggal) = $bln 
                                                            AND date_part('year',tanggal) = $thn
                                                            group by id_kry)as c"), function($join)
                                                            {
                                                                $join->on("a.id_kry","=","c.id_kry");
                                                            })
                                        ->where('nama_dpt',$dpt->nama_dpt)
                                        ->get();
        $data['jlh_peg']        = $data['absen']->count();
        $judul                  = 'Laporan_Absensi_'.$dpt->nama_dpt.'_'.$periode;
        //return view ('laporan.pdfview', $data);
        $pdf = PDF::loadview('laporan.pdfview', $data);
	    return $pdf->download($judul);
    }
}
