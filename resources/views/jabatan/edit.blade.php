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
                            Edit Data Jabatan
                        </h3>
                    </div>
                    <div class="card-body">
                        {{ Form::model($jabatan,['url'=>'jabatan/'.$jabatan->id_jbt, 'method'=>'PUT'])}}
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
                        <a href="/jabatan" class="btn btn-default">Batal</a>
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