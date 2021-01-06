@extends('template')
@section('title','Data Departemen')
@section('content')
    @include ('notif')    
    @include ('alert')
    <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-sm">
        Tambah Data Departemen
    </button>
    <!-- /.modal -->
    {{ Form::open(['url'=>'departemen'])}}
    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Departemen Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table table-condensed">
                  <tr>
                      <th>
                          Kode Departemen :
                      </th>
                  </tr>
                  <tr>
                      <td>
                          {{ Form::text('id_dpt',null,['class'=>'form-control','placeholder'=>'cth:D001'])}}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          Nama Departemen :
                      </th>
                  </tr>
                  <tr>
                      <td>
                        {{ Form::text('nama_dpt',null,['class'=>'form-control','placeholder'=>'cth:Bagian Umum'])}}
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
            <th width="200">Kode Departemen</th>
            <th>Nama Departemen</th>
            <th></th>
            <th></th>
        </tr>
    </thead>    
    <tbody>
        @foreach($departemen as $row)
        <tr>
            <td>{{ $row->id_dpt}}</td>
            <td>{{ $row->nama_dpt }}</td>
            <td width="90">
                <a href="/departemen/{{ $row->id_dpt}}/edit" class="btn btn-block bg-gradient-success btn-sm">
                Edit</a>
            </td>
            <td width="90">
                {{ Form::open(['url'=>'departemen/'.$row->id_dpt,'method'=>'delete', 'id' => 'form-delete'])}}
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