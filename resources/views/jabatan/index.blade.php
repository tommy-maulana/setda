@extends('template')
@section('title','Data Jabatan')
@section('content')
    @include ('notif')    
    @include ('alert')
    <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-sm">
        Tambah Data Jabatan
    </button>
    <!-- /.modal -->
    {{ Form::open(['url'=>'jabatan'])}}
    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Jabatan Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table table-condensed">
                  <tr>
                      <th>
                          Kode Jabatan :
                      </th>
                  </tr>
                  <tr>
                      <td>
                          {{ Form::text('id_jbt',null,['class'=>'form-control','placeholder'=>'cth:J001'])}}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          Nama Jabatan :
                      </th>
                  </tr>
                  <tr>
                      <td>
                        {{ Form::text('nama_jbt',null,['class'=>'form-control','placeholder'=>'cth:Kepala Bagian'])}}
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
    <table class="table table-bordered" id="example1">
            <thead>
        <tr>
            <th width="200">Kode Jabatan</th>
            <th>Nama Jabatan</th>
            <th></th>
            <th></th>
        </tr>
    </thead>    
    <tbody>
        @foreach($jabatan as $row)
        <tr>
            <td>{{ $row->id_jbt}}</td>
            <td>{{ $row->nama_jbt }}</td>
            <td width="90">
                <a href="/jabatan/{{ $row->id_jbt}}/edit" class="btn btn-block bg-gradient-success btn-sm">
                Edit</a>
            </td>
            <td width="90">
                {{ Form::open(['url'=>'jabatan/'.$row->id_jbt,'method'=>'delete', 'id' => 'form-delete'])}}
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