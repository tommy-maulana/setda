@extends('template')
@section('title','Data Absensi Karyawan')
@section('content')
@push('scripthead')
<!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css')}}">
@endpush
    @include ('notif')    
    @include ('alert')
    <a href="/rawdata" class="btn btn-default">Kembali</a>
    <button type="button" class="btn bg-gradient-primary float-right" data-toggle="modal" data-target="#modal-lg1">
        Tambah Data Perizinan
    </button>
    <hr>
    <table class="table table-condensed">
        <tr>
            <th>
                Nama Karyawan
            </th>
            <th>
                :
            </th>
            <td>
                {{$nama->nama_kry}}
            </td>
            <th>
                Departemen
            </th>
            <th>
                :
            </th>
            <td>
                {{$nama->nama_dpt}}
            </td>
        </tr>
        <tr>
            <th>
                
            </th>
            <th>
                
            </th>
            <td>
            </td>
            <th>
                Jabatan
            </th>
            <th>
                :
            </th>
            <td> 
                {{$nama->nama_jbt}}                           
            </td>
        </tr>
    </table>
    <hr>
    <table class="table table-bordered" id="example2">
            <thead>
        <tr>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Pulang</th>
            <th>Absen Masuk</th>
            <th>Absen Pulang</th>
        </tr>
    </thead>    
    <tbody>
        @foreach($absen as $row)
        <tr>
            <td>{{ date_format(date_create($row->tanggal), 'd F Y') }}</td>
            @if($row->status == null)
                <td>
                    @if($row->wkt_msk == null)
                        {{ date_format(date_create($normal->waktu_masuk), 'H:i')}}
                    @else
                        {{date_format(date_create($row->wkt_msk), 'H:i')}}
                    @endif
                </td>
                <td>
                    @if($row->wkt_msk == null)
                        {{ date_format(date_create($normal->waktu_pulang), 'H:i')}}
                    @else
                        {{date_format(date_create($row->wkt_plg), 'H:i')}}
                    @endif
                </td>
                @if($row->masuk == null)
                    <td>
                        <a href="/karyawan/{{$id_kry}}/{{ $row->tanggal}}/0" class="btn btn-block bg-gradient-primary btn-xs">
                            Tambah Data Absen</a>
                    </td>
                @else
                    <td>
                        {{date_format(date_create($row->masuk), 'H:i')}}            
                    </td>
                @endif
                @if($row->pulang == null)
                    <td>
                        <a href="/karyawan/{{$id_kry}}/{{ $row->tanggal}}/1" class="btn btn-block bg-gradient-primary btn-xs">
                                Tambah Data Absen</a>
                    </td>
                @else
                    <td>
                        {{date_format(date_create($row->pulang), 'H:i')}}           
                    </td>
                @endif
            @else
                <td>
                    {{$row->status}}       
                </td>
                <td>
                    ---          
                </td>
                <td>
                    ---          
                </td>
                <td>
                    ---          
                </td>
            @endif
        </tr>
        @endforeach
    </tbody>
    </table>

    <!-- /.modal-lg1 -->
    {{ Form::open(['url'=>'karyawan/'.$id_kry.'/izin'])}}
    <div class="modal fade" id="modal-lg1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Perizinan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                    <table class="table table-condensed">
                        <tr>
                            <th>Tanggal Izin</th>
                            <th>Status Izin</th>
                        </tr>
                        <tr>
                            <td>
                                {{ Form::text('tgl', null, ['class' => 'form-control float-right', 'id'=>'reservation2'])}}
                            </td>
                            <td>
                                {{ Form::select('status',$st_izin,null,['class'=>'form-control'])}}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    {{ Form::submit('Simpan Data',['class'=>'btn bg-gradient-success'])}}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>
    {{ Form::close()}}
@endsection
@push('scriptbawah')
<!-- date-range-picker -->
<script src="{{ asset("adminlte/plugins/moment/moment.min.js")}}"></script>
<script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{ asset('adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<!-- page script -->
<script>
        $(function () {
          $('#example1').DataTable()
          $('#example2').DataTable({
            'ordering'    : false,
          })
          $('#reservation2').daterangepicker()
          $('[data-mask]').inputmask()
        })
      </script>
@endpush