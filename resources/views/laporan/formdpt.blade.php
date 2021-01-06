@extends('template')
@section('title','Laporan Absensi Karyawan')
@section('content')
@push('scripthead')
<!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css')}}">
@endpush
    @include ('notif')    
    @include ('alert')
    <a href="/laporan" class="btn btn-default">Kembali</a>
    <br>
    <br>
    {{ Form::open(['url'=>''])}}
    <table class="table table-condensed">
        <tr>
            <th>
                Pilih Departemen :
            </th>
            <td>
                {{ Form::hidden('periode', $periode) }}
                {{ Form::select('id_dpt',$df_departemen,null,['class'=>'form-control'])}}
            </td>
            <td>
                {{ Form::submit('Tampilkan',['class'=>'btn bg-gradient-success'])}}
            </td>
        </tr>
    </table>    
    {{ Form::close()}}
    <hr>
@endsection
@push('scriptbawah')
<!-- date-range-picker -->
<script src="{{ asset("adminlte/plugins/moment/moment.min.js")}}"></script>
<script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Page script -->
<script>
    $(function () { 
      $('#reservation2').daterangepicker()
    })
</script>
@endpush