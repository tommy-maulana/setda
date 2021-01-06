@extends('template')
@section('title')
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
                            Tambah Absensi Manual
                        </h3>
                    </div>
                    <div class="card-body">
                        {{ Form::open(['url'=>'karyawan/'.$id_kry.'/'.$tanggal.'/'.$stat])}}
                        <table class="table table-condensed">
                            <tr>
                                <th>Tanggal Masuk</th>
                                <th colspan="3" width='25%'>Jam Absen</th>
                                <th>Ket</th>
                            </tr>
                            <tr>
                                <td>
                                    {{ Form::text('tgl', $tanggal, ['class' => 'form-control', 'readonly'=>''])}}
                                </td>
                                <td>    
                                    {{ Form::text('masukjam', null, ['class' => 'form-control', 'placeholder'=>'08', 'maxlength' => '2'])}}
                                </td>
                                <td>
                                    :
                                </td>
                                <td>                            
                                    {{ Form::text('masukmin', null, ['class' => 'form-control', 'placeholder'=>'30', 'maxlength' => '2'])}}
                                </td>
                                <td>
                                    {{ Form::select('status',$st_absen,$stat,['class'=>'form-control', 'disabled'=>''])}}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <a href="/karyawan/{{$id_kry}}" class="btn btn-default">Batal</a>
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