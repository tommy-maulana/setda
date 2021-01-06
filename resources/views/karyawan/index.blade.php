@extends('template')
@section('title','Daftar Karyawan')
@section('content')
    @include ('notif')    
    @include ('alert')
    <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-lg">
        Tambah Data Karyawan
    </button>
    <!-- /.modal -->
    {{ Form::open(['url'=>'karyawan'])}}
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Karyawan Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table table-condensed">
                  <tr>
                      <th>
                          Kode Karyawan :
                      </th>
                      <th>
                          Departemen :
                      </th>
                  </tr>
                  <tr>
                      <td>
                          {{ Form::text('id_kry',null,['class'=>'form-control','placeholder'=>'Pastikan ID Karyawan Sama Dengan ID Pada Mesin Absen'])}}
                      </td>
                      <td>
                        {{ Form::select('id_dpt',$df_departemen,null,['class'=>'form-control'])}}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          Nama Karyawan :
                      </th>
                      <th>
                          Jabatan :
                      </th>
                  </tr>
                  <tr>
                      <td>
                        {{ Form::text('nama_kry',null,['class'=>'form-control'])}}
                      </td>
                      <td>
                        {{ Form::select('id_jbt',$df_jabatan,null,['class'=>'form-control'])}}
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
                  <a href="/karyawan/{{ $row->id_kry}}/edit" class="btn btn-block bg-gradient-success btn-sm">
                  Edit</a>
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