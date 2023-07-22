<!-- Bootstrap core JavaScript-->
<script src="{{ url('backend/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ url('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ url('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ url('backend/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ url('backend/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ url('backend/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ url('backend/js/demo/chart-pie-demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- <script>
    Swal.fire({!!Session::pull('alert.config')!!});  // working 
</script> --}}

<script type="text/javascript">
    // $(document).ready(function() {

        // KODE UNTUK DELETE
        $('.delete').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            $('.delete_form').submit();
                        }
                    })
                }
            })
        })
    // })
</script>
