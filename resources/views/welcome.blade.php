@extends('templatehome')
@section('title','Absensi Setda OKI')
@section('content')
    @include ('notif')    
    @include ('alert')
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h4>Selamat Datang Di Aplikasi Pengolah Data Absensi Karyawan</h4>
                </div>
                <div class="card-body">
                  {{ Auth::user()->name }}
                    <br> <br>Sekretariat Daerah <br> Kabupaten Ogan Komering Ilir
                </div>
                <div class="card-footer">
                    Tanggal Hari Ini: {{date('l, d F Y')}}
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span>Jumlah Karyawan</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-muted">7 Hari Terakhir</span>
                    </p>
                    </div>
                    <!-- /.d-flex -->

                    <div class="position-relative mb-4">
                        <canvas id="terlambat-1-mggu" height="200"></canvas>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                            <i class="fas fa-square text-gray"></i> Terlambat Datang
                        </span>
                        <span>
                            <i class="fas fa-square text-primary"></i> Pulang Cepat
                        </span>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                    <h3 class="card-title">Satu Minggu Terakhir</h3>
                    </div>
                </div>
                <div class="card-body">    
                    <div class="position-relative mb-4">
                        <canvas id="det-1-mggu" height="200"></canvas>
                    </div>
    
                    <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                            <i class="fas fa-square text-gray"></i> Terlambat Datang
                        </span>
                        <span>
                            <i class="fas fa-square text-primary"></i> Pulang Cepat
                        </span>
                    </div>
                </div>
                </div>
                <!-- /.card -->
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Bulan Kemarin</h3>
                    </div>
                </div>
                <div class="card-body">    
                    <div class="position-relative mb-4">
                    <canvas id="det-1-bln" height="200"></canvas>
                    </div>
    
                    <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                        <i class="fas fa-square text-gray"></i> Terlambat Datang
                    </span>
                    <span>
                        <i class="fas fa-square text-primary"></i> Pulang Cepat
                    </span>
                    </div>
                </div>
                </div>
                <!-- /.card -->
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Karyawan Tidak Masuk</h3>
                    </div>
                </div>
                <div class="card-body">    
                    <div class="position-relative mb-4">
                        <canvas id="tdk-msk" height="200"></canvas>
                    </div>
    
                    <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                        <i class="fas fa-square text-gray"></i> Bulan Kemarin
                    </span>
    
                    <span>
                        <i class="fas fa-square text-primary"></i> Bulan Ini
                    </span>
                    </div>
                </div>
                </div>
                <!-- /.card -->
        </div>
    </div>
@endsection
@push('scriptbawah')
<!-- page script -->
<script>
$(function () {
    'use strict'
  
    var ticksStyle = {
      fontColor: '#495057',
      fontStyle: 'bold'
    }
    var mode      = 'index'
    var intersect = true
  
    var $tmsk = $('#tdk-msk')
    var tmsk  = new Chart($tmsk, {
      type   : 'bar',
      data   : {
        labels  : ['Izin', 'Sakit', 'Cuti', 'Dinas Luar'],
        datasets: [        
          {
            backgroundColor: '#ced4da',
            borderColor    : '#ced4da',
            data           : ['{{$b->izin}}','{{$b->sakit}}','{{$b->cuti}}','{{$b->dl}}}}']
          },
          {
            backgroundColor: '#007bff',
            borderColor    : '#007bff',
            data           : ['{{$a->izin}}','{{$a->sakit}}','{{$a->cuti}}','{{$a->dl}}}}']
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips           : {
          mode     : mode,
          intersect: intersect
        },
        hover              : {
          mode     : mode,
          intersect: intersect
        },
        legend             : {
          display: false
        },
        scales             : {
          yAxes: [{
            // display: false,
            gridLines: {
              display      : true,
              lineWidth    : '4px',
              color        : 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks    : $.extend({
              beginAtZero: true,
              suggestedMax: 14,
              // Include a dollar sign in the ticks
              callback: function (value, index, values) {
                if (value >= 1000) {
                  value /= 1000
                  value += 'k'
                }
                return  value
              }}, ticksStyle)
          }],
          xAxes: [{
            display  : true,
            gridLines: {
              display: false
            },
            ticks    : ticksStyle
          }]
        }
      }
    })
    var $detmggu = $('#det-1-mggu')
    var detmggu  = new Chart($detmggu, {
      type   : 'bar',
      data   : {
        labels  : ['10-30', '31-60', '61-90', '>90'],
        datasets: [        
          {
            backgroundColor: '#ced4da',
            borderColor    : '#ced4da',
            data           : ['{{$det_mggu->a}}','{{$det_mggu->b}}','{{$det_mggu->c}}','{{$det_mggu->d}}']
          },
          {
            backgroundColor: '#007bff',
            borderColor    : '#007bff',
            data           : ['{{$det_mggu->e}}','{{$det_mggu->f}}','{{$det_mggu->g}}','{{$det_mggu->h}}']
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips           : {
          mode     : mode,
          intersect: intersect
        },
        hover              : {
          mode     : mode,
          intersect: intersect
        },
        legend             : {
          display: false
        },
        scales             : {
          yAxes: [{
            // display: false,
            gridLines: {
              display      : true,
              lineWidth    : '4px',
              color        : 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks    : $.extend({
              beginAtZero: true,
              suggestedMax: 14,
              // Include a dollar sign in the ticks
              callback: function (value, index, values) {
                if (value >= 1000) {
                  value /= 1000
                  value += 'k'
                }
                return  value
              }
            }, ticksStyle)
          }],
          xAxes: [{
            display  : true,
            gridLines: {
              display: false
            },
            ticks    : ticksStyle
          }]
        }
      }
    })
    var $detbln = $('#det-1-bln')
    var detbln  = new Chart($detbln, {
      type   : 'bar',
      data   : {
        labels  : ['10-30', '31-60', '61-90', '>90'],
        datasets: [        
          {
            backgroundColor: '#ced4da',
            borderColor    : '#ced4da',
            data           : ['{{$det_bln_kmrn->a}}','{{$det_bln_kmrn->b}}','{{$det_bln_kmrn->c}}','{{$det_bln_kmrn->d}}']
          },
          {
            backgroundColor: '#007bff',
            borderColor    : '#007bff',
            data           : ['{{$det_bln_kmrn->e}}','{{$det_bln_kmrn->f}}','{{$det_bln_kmrn->g}}','{{$det_bln_kmrn->h}}']
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips           : {
          mode     : mode,
          intersect: intersect
        },
        hover              : {
          mode     : mode,
          intersect: intersect
        },
        legend             : {
          display: false
        },
        scales             : {
          yAxes: [{
            // display: false,
            gridLines: {
              display      : true,
              lineWidth    : '4px',
              color        : 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks    : $.extend({
              beginAtZero: true,
              suggestedMax: 14,  
              // Include a dollar sign in the ticks
              callback: function (value, index, values) {
                if (value >= 1000) {
                  value /= 1000
                  value += 'k'
                }
                return  value
              }
            }, ticksStyle)
          }],
          xAxes: [{
            display  : true,
            gridLines: {
              display: false
            },
            ticks    : ticksStyle
          }]
        }
      }
    })

    var $mggu = $('#terlambat-1-mggu')
    var mggu  = new Chart($mggu, {
      data   : {
        labels  : @json($last_mggu_tgl),//['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],            
        
        datasets: [
          {
            type                : 'line',
            data                : @json($last_mggu_telat),
            backgroundColor     : 'tansparent',
            borderColor         : '#ced4da',
            pointBorderColor    : '#ced4da',
            pointBackgroundColor: '#ced4da',
            fill                : false
            // pointHoverBackgroundColor: '#ced4da',
            // pointHoverBorderColor    : '#ced4da'
          },
          {
          type                : 'line',
          data                : @json($last_mggu_cepat),
          backgroundColor     : 'transparent',
          borderColor         : '#007bff',
          pointBorderColor    : '#007bff',
          pointBackgroundColor: '#007bff',
          fill                : false
          // pointHoverBackgroundColor: '#007bff',
          // pointHoverBorderColor    : '#007bff'
          }]
      },
      options: {
        maintainAspectRatio: false,
        tooltips           : {
          mode     : mode,
          intersect: intersect
        },
        hover              : {
          mode     : mode,
          intersect: intersect
        },
        legend             : {
          display: false
        },
        scales             : {
          yAxes: [{
            // display: false,
            gridLines: {
              display      : true,
              lineWidth    : '4px',
              color        : 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks    : $.extend({
              beginAtZero : true,
              suggestedMax: 14
            }, ticksStyle)
          }],
          xAxes: [{
            display  : true,
            gridLines: {
              display: false
            },
            ticks    : ticksStyle
          }]
        }
      }
    })
    
  })

</script>
@endpush