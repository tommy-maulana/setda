@push('scripthead')
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset ('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset ('adminlte/plugins/toastr/toastr.min.css')}}">
@endpush
@if(session('pesan')== 'sukses')
    @push('scriptbawah')
        <script type="text/javascript">
            $(function() {
                const Toast = Swal.mixin({
                    toast: true,
                    //position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                $('.swalDefaultSuccess').ready(function() {
                    Toast.fire({
                    type: 'success',
                    title: 'Data Berhasil Diubah'
                    })
                });
            });  
        </script>
    @endpush
@elseif(session('pesan')== 'delete')
    @push('scriptbawah')
        <script type="text/javascript">
            $(function() {
                const Toast = Swal.mixin({
                    toast: true,
                    //position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                $('.swalDefaultError').ready(function() {
                Toast.fire({
                    type: 'error',
                    title: 'Data Berhasil Dihapus'
                })
                });
            });  
        </script>
    @endpush
@elseif(session('pesan')== 'upload')
    @push('scriptbawah')
        <script type="text/javascript">
            $(function() {
                const Toast = Swal.mixin({
                    toast: true,
                    //position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                $('.swalDefaultError').ready(function() {
                Toast.fire({
                    type: 'success',
                    title: 'Data Berhasil Diupload'
                })
                });
            });  
        </script>
    @endpush
@endif