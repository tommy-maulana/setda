@extends('template')
@section('title','Laporan Absensi Karyawan')
@section('content')
@push('scripthead')
@endpush
    @include ('notif')    
    @include ('alert')    
    <a href="/laporan" class="btn btn-default">Kembali</a>
    <a href="/laporan/export/{{$id_dpt}}/{{$bln}}/{{$thn}}" class="btn bg-gradient-success float-right">Export</a>
    <br>
    <br>
    <table class="table table-condensed">
        <tr>
            <th>
                Nama departemen
            </th>
            <th>
                :
            </th>
            <td>
                {{$departemen}}
            </td>
            <th>
                Periode
            </th>
            <th>
                :
            </th>
            <td>
                {{$periode}}
            </td>
        </tr>
        <tr>
            <th>
                Jumlah Pegawai
            </th>
            <th>
                :
            </th>
            <td>
                {{$jlh_peg}}
            </td>
            <th>
                Jumlah Hari Kerja
            </th>
            <th>
                :
            </th>
            <td> 
                {{$workday}}                              
            </td>
        </tr>
    </table>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2">Nama Karyawan</th>
                <th rowspan="2">Jabatan</th>
                <th colspan="4">Tidak Masuk</th>
                <th rowspan="2">DL</th>
                <th colspan="4">Datang Terlambat &amp; Pulang Lebih Cepat </th>
                <th rowspan="2">Total Masuk Kerja</th>
            </tr>
            <tr>
                <th>I</th>
                <th>S</th>
                <th>C</th>
                <th>TK</th>
                <th>&lt;30m</th>
                <th>&lt;60m</th>
                <th>&lt;90m</th>
                <th>&gt;90m</th>
            </tr>
        </thead>    
        <tbody>
            @foreach ($absen as $row)                
            <tr>
                <td>
                    @if($row->status != 'Aktif')
                        {{$row->nama_kry.' ('.$row->status.')'}}
                    @else
                        {{$row->nama_kry}}
                    @endif
                </td>
                <td>{{$row->nama_jbt}}</td>
                <td>{{$row->izin}}</td>
                <td>{{$row->sakit}}</td>
                <td>{{$row->cuti}}</td>
                <td>{{$workday - ($row->izin + $row->sakit + $row->cuti + $row->dl + $row->absen)}}</td>
                <td>{{$row->dl}}</td>
                <td>{{$row->t}}</td>
                <td>{{$row->e}}</td>
                <td>{{$row->s}}</td>
                <td>{{$row->l}}</td>
                <td>{{$row->absen}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@push('scriptbawah')
@endpush