@extends('template')
@section('title','')
@section('content')
@include ('notif')    
@include ('alert')
        <div class="row mb-2">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-6">
                <div class="card card-default card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Edit Kalender
                        </h3>
                        {{ Form::open(['url'=>'kalender/'.$kal->id,'method'=>'delete', 'id' => 'form-delete'])}}
                            {{ Form::submit('Hapus Data',['class'=>'btn btn-sm float-right bg-gradient-danger swalAlrt'])}}
                        {{ Form::close()}}
                    </div>
                    <div class="card-body">
                        {{ Form::model($kal,['url'=>'kalender/'.$kal->id, 'method'=>'PUT'])}}                        
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
                                    {{ Form::text('id',null,['class'=>'form-control', 'hidden'])}}
                                    {{ Form::text('deskrip',null,['class'=>'form-control'])}}
                                </td>
                                <td>
                                    {{ Form::date('tgl', null, ['class' => 'form-control'])}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ Form::select('status',['0'=>'Masuk', '1'=>'Libur'],null,['class'=>'form-control'])}}
                                </td>
                                <td>
                                    <div id ="row_dim">
                                    Masuk : {{ Form::time('wkt_msk',null,['class'=>'form-control'])}}
                                    Pulang : {{ Form::time('wkt_plg',null,['class'=>'form-control'])}}
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <a href="/kalender" class="btn btn-default">Batal</a>
                        {{ Form::submit('Simpan Data',['class'=>'btn btn-block bg-gradient-success'])}}
                    </div>
                    <!-- /.card -->
                        {{ Form::close()}}
              </div>
            </div>
            <div class="col-sm-3">
            </div>
        </div>
@endsection
@push('scriptbawah')
<!-- date-range-picker -->
<script src="{{ asset("adminlte/plugins/moment/moment.min.js")}}"></script>
<script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Page script -->
@endpush