@extends('template')
@section('title','Kalender Kerja')
@section('content')
@push('scripthead')
<!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css')}}">
@endpush
    @include ('notif')    
    @include ('alert')
    <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-lg">
        Kalender Kerja
    </button>
    <!-- /.modal -->
    {{ Form::open(['url'=>'kalender'])}}
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Kalender Kerja</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <table class="table table-condensed">
                    <tr>
                        <th>
                            Nama Kegiatan / Jadwal :
                        </th>
                        <th>
                            Tanggal Kegiatan / Jadwal
                        </th>
                    </tr>
                    <tr>
                        <td>
                            {{ Form::text('keg',null,['class'=>'form-control'])}}
                        </td>
                        <td>
                            {{ Form::text('tgl', null, ['class' => 'form-control float-right', 'id'=>'reservation2'])}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="ket" id="type" class="form-control">
                                <option name="masuk" value="0">Masuk</option>
                                <option name="libur" value="1">Libur</option>
                            </select>
                        </td>
                        <td id="row_dim">
                            {{ Form::select('jam_krj',$jamkrj,null,['class'=>'form-control'])}}
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
    <!-- /.modal -->
    <hr>
    <table class="table table-bordered" id="example2">
            <thead>
        <tr>
            <th width="200">Nama Kegiatan</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Jam Kerja Berlaku</th>
            <th></th>
        </tr>
    </thead>    
    <tbody>
        @foreach($kalender as $row)
        <tr>
            <td>{{ $row->nama_kegiatan}}</td>
            <td>{{ date_format(date_create($row->tgl_mulai), "d F Y")}} </td>
            <td>{{ date_format(date_create($row->tgl_selesai), "d F Y")}} </td>
            <td>
                @if( $row->status == '1')
                    -- Libur --
                @else
                    {{ 
                        $row->ket
                        ." (".
                        date_format(date_create($row->waktu_masuk), "H:i")
                        ." - ".
                        date_format(date_create($row->waktu_pulang), "H:i")
                        .")"
                    }}
                @endif                
            </td>
            <td width="90">
                {{ Form::open(['url'=>'kalender/'.$row->id,'method'=>'delete', 'id' => 'form-delete'])}}
                <button type="submit" class="btn btn-block bg-gradient-danger btn-sm swalAlrt"><i class="fa fa-trash-o" aria-hidden="true"></i>
                    Hapus</button>
                {{ Form::close()}}
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
@endsection
@push('scriptbawah')
<!-- date-range-picker -->
<script src="{{ asset("adminlte/plugins/moment/moment.min.js")}}"></script>
<script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Page script -->
<script>
    $(function () { 
      $('#reservation2').daterangepicker()
      $('#row_dim').show(); 
        $('#type').change(function(){
            if($('#type').val() == '1') {
                $('#row_dim').hide(); 
            } else {
                $('#row_dim').show(); 
            } 
        });
    })
</script>
@endpush