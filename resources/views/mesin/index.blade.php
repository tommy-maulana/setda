@extends('template')
@section('title','Data Mesin Finger')
@section('content')
    @include ('notif')    
    @include ('alert')
    <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-lg">
        Tambah Data Mesin
    </button>
    <!-- /.modal -->
    {{ Form::open(['url'=>'mesin'])}}
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Mesin Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table table-condensed">
                  <tr>
                      <th>
                          Lokasi Mesin :
                      </th>
                      <th>
                          Alamat IP :
                      </th>
                  </tr>
                  <tr>
                      <td>
                        {{ Form::text('nama_mesin',null,['class'=>'form-control','placeholder'=>'cth: Loby Bawah'])}}
                      </td>
                      <td>
                        {{ Form::text('ip_mesin',null,['class'=>'form-control', "data-inputmask"=>"'alias': 'ip'", "data-mask"=>"", "im-insert"=>"true"])}}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          Port Mesin :
                      </th>
                      <th>
                          Password Komunikasi Mesin :
                      </th>
                  </tr>
                  <tr>
                      <td>
                        {{ Form::text('port',null,['class'=>'form-control'])}}
                      </td>
                      <td>
                        {{ Form::text('comkey',null,['class'=>'form-control'])}}
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
            <th width="200">Lokasi Mesin Finger</th>
            <th>IP Mesin</th>
            <th>Port</th>
            <th>ComKey</th>
            <th></th>
            <th></th>
        </tr>
    </thead>    
    <tbody>
        @foreach($mesin as $row)
        <tr>
            <td>{{ $row->nama_mesin}}</td>
            <td>{{ $row->ip_mesin }}</td>
            <td>{{ $row->port }}</td>
            <td>{{ $row->comkey }}</td>
            <td width="90">
                <a href="/mesin/{{ $row->id}}/edit" class="btn btn-block bg-gradient-success btn-sm">
                Edit</a>
            </td>
            <td width="90">
                {{ Form::open(['url'=>'mesin/'.$row->id,'method'=>'delete', 'id' => 'form-delete'])}}
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