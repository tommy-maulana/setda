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
                        {{ Form::model($karyawan,['url'=>'karyawan/'.$karyawan->id_kry, 'method'=>'PUT'])}}
                        <table class="table table-condensed">
                            <tr>
                                <th>
                                    Nama Karyawan :
                                </th>
                                <th>
                                    Status :
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    {{ Form::text('nama_kry',null,['class'=>'form-control','placeholder'=>'cth:Kepala Bagian'])}}
                                </td>
                                <td>
                                    {{ Form::select('status',$df_status,null,['class'=>'form-control'])}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Departemen :
                                </th>
                                <th>
                                    Jabatan :
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    {{ Form::select('id_dpt',$df_departemen,null,['class'=>'form-control'])}}
                                  </td>
                                <td>
                                    {{ Form::select('id_jbt',$df_jabatan,null,['class'=>'form-control'])}}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <a href="/karyawan" class="btn btn-default">Batal</a>
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