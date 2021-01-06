@extends('template')
@section('title','Update Database Mesin Finger')
@section('content')
    @include ('notif')    
    @include ('alert')
    <table class="table table-bordered" id="example2">
            <thead>
        <tr>
            <th rowspan="2">Lokasi Mesin Finger</th>
            <th colspan="2">Terakhir Update</th>
            <th rowspan="2"></th>
        </tr>
        <tr>
            <th>Tanggal</th>
            <th>Jam</th>
            <th></th>
        </tr>
    </thead>    
    <tbody>
        @foreach($datamesin as $row)
        {{ Form::open(['url'=>'uploadnama','method'=>'POST', 'id' => 'form-uploadnama'])}}
        <tr>
            <td>
                {{ $row->nama_mesin}}
                {{ Form::text('id',$row->id,['hidden'=>'true'])}}
                {{ Form::text('ip',$row->ip_mesin,['hidden'=>'true'])}}
                {{ Form::text('port',$row->port,['hidden'=>'true'])}}
                {{ Form::text('key',$row->comkey,['hidden'=>'true'])}}
                {{ Form::text('tgl',$row->tgl_update,['hidden'=>'true'])}}
            </td>
            <td>
                @if($row->tgl_update == null)
                Mesin Belum Diupdate
                @else
                {{ date_format(date_create($row->tgl_update),'l, d M Y') }}
                @endif
            </td>
            <td>
                @if($row->tgl_update == null)
                Mesin Belum Diupdate
                @else
                {{ date_format(date_create($row->tgl_update),'H:i') }}
                @endif
            </td>
            <td width="90">
                <button type="submit" class="btn btn-block bg-gradient-success btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i>
                    Update</button>
            </td>
        </tr>
        {{ Form::close()}}
        @endforeach
    </tbody>
    </table>
@endsection
@push('scriptbawah')
<script src="{{ asset('adminlte/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<!-- page script -->
<script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false
      })

      $('[data-mask]').inputmask()
    })
  </script>
@endpush