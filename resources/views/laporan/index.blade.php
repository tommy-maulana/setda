@extends('template')
@section('title','Laporan Absensi Karyawan')
@section('content')
@push('scripthead')
<!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css')}}">
@endpush
    @include ('notif')    
    @include ('alert')
    {{ Form::open(['url'=>'laporan/coba'])}}
    <table class="table table-condensed">
        <tr>
            <th>
                Pilih Departemen :
            </th>
            <th colspan="2">
                Pilih Periode Laporan :
            </th>
            <th>
                
            </th>
        </tr>
        <tr>
            <td>
                {{ Form::select('id_dpt',$df_departemen,null,['class'=>'form-control'])}}
            </td>
            <td>
                {{ Form::selectMonth('bln', date('n'), ['class' => 'form-control', 'width'=>'25%'])}}
            </td>
            <td>
                {{ Form::selectYear('thn', '2020', '2050', null, ['class' => 'form-control'])}}
            </td>
            <td width=55%>
                {{ Form::submit('Lihat Laporan',['class'=>'btn bg-gradient-success'])}}
            </td>
        </tr>
    </table>    
    {{ Form::close()}}
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