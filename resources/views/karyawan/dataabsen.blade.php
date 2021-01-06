@extends('template')
@section('title','Data Absensi Karyawan')
@section('content')
    @include ('notif')    
    @include ('alert')
    <table class="table table-bordered" id="example1">
            <thead>
        <tr>
            <th>Nama Karyawan</th>
            <th>Departemen</th>
            <th>Jabatan</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>    
    <tbody>
        @foreach($karyawan as $row)
        <tr>
            <td>{{ $row->nama_kry }}</td>
            <td>{{ $row->nama_dpt }}</td>
            <td>{{ $row->nama_jbt }}</td>
            <td>{{ $row->status }}</td>
            <td width="90">
                <a href="/karyawan/{{ $row->id_kry}}" class="btn btn-block bg-gradient-success btn-sm">
                Lihat</a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
@endsection
@push('scriptbawah')
<!-- page script -->
<script>
        $(function () {
          $('#example1').DataTable()
          $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
          })
        })
      </script>
@endpush