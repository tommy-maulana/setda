<!DOCTYPE html>
<html>
<head>
	<!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('adminlte/ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
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
                <td>{{$workday - ($row->izin + $row->sakit + $row->cuti + $row->dl + $row->l)}}</td>
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

    <!-- jQuery -->
<script src=" {{ asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/dist/js/demo.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<!-- SweetAlert2 -->
<script src="{{asset('adminlte/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('adminlte/plugins/toastr/toastr.min.js')}}"></script>
</body>
</html>