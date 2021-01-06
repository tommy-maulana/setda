@extends('template')
@section('title','Kalender Kerja')
@section('content')
@push('scripthead')
<!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href='{{ asset('calendar/core/main.css')}}' />
  <link rel="stylesheet" href='{{ asset('calendar/daygrid/main.css')}}' />
  <style>

    body {
      margin: 40px 10px;
      padding: 0;
      font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
      font-size: 14px;
    }
  
    #calendar {
      max-width: 900px;
      margin: 0 auto;
    }
  
  </style>
@endpush
    @include ('notif')    
    @include ('alert')
    <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-lg">
        Kalender Kerja
    </button>
    <!-- /.modal -->
    {{ Form::open(['url'=>'kalender'])}}
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Kalender Kerja</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
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
                            {{ Form::text('keg',null,['class'=>'form-control'])}}
                        </td>
                        <td>
                            {{ Form::text('tgl', null, ['class' => 'form-control float-right', 'id'=>'reservation2'])}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="ket" id="type" class="form-control">
                                <option name="masuk" value="0">Masuk</option>
                                <option name="libur" value="1">Libur</option>
                            </select>
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
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              {{ Form::submit('Simpan Data',['class'=>'btn bg-gradient-success'])}}
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      {{ Form::close()}}
    <!-- /.modal -->
    <hr>
    <div id='calendar'></div>
@endsection
@push('scriptbawah')
<!-- date-range-picker -->
<script src="{{ asset("adminlte/plugins/moment/moment.min.js")}}"></script>
<script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src='{{ asset('calendar/core/main.js')}}'></script>
<script src='{{ asset('calendar/interaction/main.js')}}'></script>
<script src='{{ asset('calendar/daygrid/main.js')}}'></script>
<!-- Page script -->
<script>

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
  
      var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'interaction', 'dayGrid' ],
        events: [
            @foreach($tanggal as $row)
                {
                    title : '{{ $row->deskrip }}',
                    start : '{{ $row->tgl }}',
                    url : '{{ route('kalender.edit', $row->id) }}'
                },
            @endforeach
        ]
      });
  
      calendar.render();
    });
  
  </script>
<script>   
    $(function () { 
      $('#reservation2').daterangepicker()
      $('#row_dim').show(); 
        $('#type').change(function(){
            if($('#type').val() == '1') {
                $('#row_dim').hide(); 
            } else {
                $('#row_dim').show(); 
            } 
        });
    })
</script>
@endpush