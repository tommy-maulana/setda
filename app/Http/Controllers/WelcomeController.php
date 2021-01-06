<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $bulan_ini  = date('m');
        $bulan_kmrin    =   $bulan_ini - 1;
        $tahun          =   date('Y');
        $data['a']  = \DB::table('view_absen_kry')
                                    ->selectRaw("count(*) filter (where status = 'Izin') as izin,
                                                count(*) filter (where status = 'Sakit') as sakit,
                                                count(*) filter (where status = 'Cuti') as cuti,
                                                count(*) filter (where status = 'Dinas Luar') as dl")
                                    ->whereRaw("date_part('month',tanggal) = $bulan_ini 
                                                AND date_part('year',tanggal) = $tahun")
                                    ->first();
        $data['b']  = \DB::table('view_absen_kry')
                                    ->selectRaw("count(*) filter (where status = 'Izin') as izin,
                                                count(*) filter (where status = 'Sakit') as sakit,
                                                count(*) filter (where status = 'Cuti') as cuti,
                                                count(*) filter (where status = 'Dinas Luar') as dl")
                                    ->whereRaw("date_part('month',tanggal) = $bulan_kmrin 
                                                AND date_part('year',tanggal) = $tahun")
                                    ->first();
        $data['det_bln_kmrn']   =   \DB::table('view_terlambat_home')
                                    ->selectRaw("count(tlmbt) filter(where tlmbt Between 10 AND 60) as a,
                                                count(tlmbt) filter(where tlmbt Between 31 AND 60) as b,
                                                count(tlmbt) filter(where tlmbt Between 61 AND 90) as c,
                                                count(tlmbt) filter(where tlmbt >90) as d,
                                                count(cepat) filter(where cepat Between 1 AND 60) as e,
                                                count(cepat) filter(where cepat Between 31 AND 60) as f,
                                                count(cepat) filter(where cepat Between 61 AND 90) as g,
                                                count(cepat) filter(where cepat >90) as h")
                                    ->whereRaw("date_part('month',tanggal) = $bulan_kmrin 
                                                AND date_part('year',tanggal) = $tahun")
                                    ->first();
        $data['det_mggu']   =   \DB::table('view_terlambat_home')
                                    ->selectRaw("count(tlmbt) filter(where tlmbt Between 10 AND 60) as a,
                                                count(tlmbt) filter(where tlmbt Between 31 AND 60) as b,
                                                count(tlmbt) filter(where tlmbt Between 61 AND 90) as c,
                                                count(tlmbt) filter(where tlmbt >90) as d,
                                                count(cepat) filter(where cepat Between 1 AND 60) as e,
                                                count(cepat) filter(where cepat Between 31 AND 60) as f,
                                                count(cepat) filter(where cepat Between 61 AND 90) as g,
                                                count(cepat) filter(where cepat >90) as h")
                                    ->whereRaw("tanggal > current_date - interval '7 days'")
                                    ->first();
        $data['last_mggu_tgl']  =   \DB::table('view_tgl_not_libur AS a')->distinct()
                                    ->selectRaw("date_part('day',a.tgl)as tgl")
                                    ->whereRaw("tgl > current_date - interval '8 days'")
                                    ->orderBy('tgl', 'desc')
                                    ->get()->pluck('tgl');
        $data['last_mggu_telat']  =   \DB::table('view_tgl_not_libur AS a')->distinct()
                                    ->selectRaw("date_part('day',a.tgl)as tgl")
                                    ->selectRaw("(case when b.telat is null then '0' else b.telat end)as telat")
                                    ->selectRaw("(case when b.cepat is null then '0' else b.cepat end)as cepat")
                                    ->leftJoin(\DB::raw("(select tanggal, 
                                                        count(tlmbt) filter(where tlmbt >0) as telat, 
                                                        count(cepat) filter(where cepat >0) as cepat
                                                        FROM view_terlambat_home 
                                                        WHERE tanggal > current_date - interval '8 days'
	                                                    GROUP BY tanggal
                                                        )as b"), function($join)
                                                        {
                                                            $join->on("a.tgl","=","b.tanggal");
                                                        })
                                    ->whereRaw("tgl > current_date - interval '8 days'")
                                    ->orderBy('tgl', 'desc')
                                    ->get()->pluck('telat');
        $data['last_mggu_cepat']  =   \DB::table('view_tgl_not_libur AS a')->distinct()
                                    ->selectRaw("date_part('day',a.tgl)as tgl")
                                    ->selectRaw("(case when b.telat is null then '0' else b.telat end)as telat")
                                    ->selectRaw("(case when b.cepat is null then '0' else b.cepat end)as cepat")
                                    ->leftJoin(\DB::raw("(select tanggal, 
                                                        count(tlmbt) filter(where tlmbt >0) as telat, 
                                                        count(cepat) filter(where cepat >0) as cepat
                                                        FROM view_terlambat_home 
                                                        WHERE tanggal > current_date - interval '8 days'
	                                                    GROUP BY tanggal
                                                        )as b"), function($join)
                                                        {
                                                            $join->on("a.tgl","=","b.tanggal");
                                                        })
                                    ->whereRaw("tgl > current_date - interval '8 days'")
                                    ->orderBy('tgl', 'desc')
                                    ->get()->pluck('cepat');
        return view('welcome', $data);
        //return $data['last_mggu']->telat;
    }
}
