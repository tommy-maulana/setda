@extends('template')
@section('title','Data Jabatan')
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
                            Edit Data Karyawan
                        </h3>
                    </div>
                    <div class="card-body">
                        {{ Form::model($jamkerja,['url'=>'jamkerja/'.$jamkerja->id, 'method'=>'PUT'])}}
                        <table class="table table-condensed">
                            <tr>
                                <th colspan="2">
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
                                    {{ Form::time('waktu_masuk',null,['class'=>'form-control'])}}
                                </td>
                            </tr>
                            <tr>
                                <th>Jam Pulang</th>
                                <td>
                                    {{ Form::time('waktu_pulang',null,['class'=>'form-control'])}}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <a href="/jamkerja" class="btn btn-default">Batal</a>
                        {{ Form::submit('Simpan Data',['class'=>'btn bg-gradient-success'])}}
                    </div>
                    <!-- /.card -->
                        {{ Form::close()}}
              </div>
            </div>
            <div class="col-sm-3">
            </div>
        </div>
@endsection