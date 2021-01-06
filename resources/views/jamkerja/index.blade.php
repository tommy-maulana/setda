@extends('template')
@section('title','Data Jam Kerja')
@section('content')
    @include ('notif')    
    @include ('alert')
    <!-- /.modal
    <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-sm">
        Tambah Shift Kerja
    </button>
    {{ Form::open(['url'=>'jamkerja'])}}
    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Shift Kerja Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <table class="table table-condensed">
                    <tr>
                        <th colspan="4">
                            Nama Shift :
                        </th>
                    </tr>
                    <tr>
                        <td colspan="4">
                            {{ Form::text('ket',null,['class'=>'form-control'])}}
                        </td>
                    </tr>
                    <tr>
                        <th>Jam Masuk</th>
                        <td>    
                            {{ Form::text('masukjam', null, ['class' => 'form-control', 'placeholder'=>'08', 'maxlength' => '2'])}}
                        </td>
                        <td>
                            :
                        </td>
                        <td>                            
                            {{ Form::text('masukmin', null, ['class' => 'form-control', 'placeholder'=>'30', 'maxlength' => '2'])}}
                        </td>
                    </tr>
                    <tr>
                        <th>Jam Pulang</th>
                        <td>
                            {{ Form::text('pulangjam', null, ['class' => 'form-control', 'placeholder'=>'16', 'maxlength' => '2'])}}
                        </td>
                        <td>
                            :
                        </td>
                        <td>                             
                            {{ Form::text('pulangmin', null, ['class' => 'form-control', 'placeholder'=>'30', 'maxlength' => '2'])}}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              {{ Form::submit('Simpan Data',['class'=>'btn bg-gradient-success'])}}
            </div>
          </div>
        </div>
      </div>
      {{ Form::close()}}
     /.modal -->
    <hr>
    <table class="table table-bordered" id="example2">
            <thead>
        <tr>
            <th width="200">Nama Shift</th>
            <th>Jam Masuk</th>
            <th>Jam Pulang</th>
            <th></th>
        </tr>
    </thead>    
    <tbody>
        @foreach($jamkerja as $row)
        <tr>
            <td>{{ $row->ket}}</td>
            <td>{{ date_format(date_create($row->waktu_masuk), "H:i")}} </td>
            <td>{{ date_format(date_create($row->waktu_pulang), "H:i")}} </td>
            <td width="90">
                <a href="/jamkerja/{{ $row->id}}/edit" class="btn btn-block bg-gradient-success btn-sm">
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
            'paging'      : false,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true
          })
        })
</script>
@endpush