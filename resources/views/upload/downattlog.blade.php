@extends('template')
@section('title','Download Data Absensi')
@section('content')
    @include ('notif')    
    @include ('alert')
    <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-sm">
        Import Data Absen
    </button>
    <!-- /.modal -->
    <form action="/downattlog/imp" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal fade" id="modal-sm">
            <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Import Data Absen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    File :
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file">
                        <label class="custom-file-label" for="file">Choose file</label>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input type="submit" value="Import File" class="btn btn-block bg-gradient-success">
                </div>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </form>
    <!-- /.modal -->
    <hr>
    <!--
    <table class="table table-bordered" id="example2">
        <thead>
            <tr>
                <th>Lokasi Mesin Finger</th>
                <th>Terakhir Update</th>
            </tr>
        </thead>    
        <tbody>
            @foreach($datamesin as $row)
            <tr>
                <td>
                    {{ $row->nama_mesin}}
                </td>
                <td>
                    @if($row->tgl == null)
                    Mesin Belum Diupdate
                    @else
                    {{ date_format(date_create($row->tgl),'l, d M Y') }}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    -->
@endsection
@push('scriptbawah')
<script src="{{ asset('adminlte/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- page script -->
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
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