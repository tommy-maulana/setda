@extends('template')
@section('title','Data Departemen')
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
                            Edit Data Departemen
                        </h3>
                    </div>
                    <div class="card-body">
                        {{ Form::model($departemen,['url'=>'departemen/'.$departemen->id_dpt, 'method'=>'PUT'])}}
                        <table class="table table-condensed">
                            <tr>
                                <th>
                                    ID Departemen :
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
                        <a href="/departemen" class="btn btn-default">Batal</a>
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