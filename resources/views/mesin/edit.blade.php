@extends('template')
@section('title','Data Mesin Finger')
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
                            Edit Data Mesin Finger
                        </h3>
                    </div>
                    <div class="card-body">
                        {{ Form::model($mesin,['url'=>'mesin/'.$mesin->id, 'method'=>'PUT'])}}
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
                        <a href="/mesin" class="btn btn-default">Batal</a>
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