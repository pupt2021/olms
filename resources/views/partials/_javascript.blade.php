<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js')}}"></script>
<script src="{{ asset('js/demo.js')}}"></script>

{{-- Datatables 4--}}
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- jquery-validation -->
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

{{--Select2--}}
<script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>


{{-- FIle Upload --}}
<script src="{{ asset('js/fileinput.js') }}"></script>

<script>

    $(document).ready(function(){

        var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                bjQueryUI: true,
                ajax : {
                    url : "{{ route('DTR.search') }}",
                    type : "GET",
                    dataType: 'JSON'
                },
                columns: [
                    {data: 'materials_id', name: 'materials_id'},
                    {data: 'accnum', name: 'accnum'},
                    {data: 'isbn', name: 'isbn'},
                    {data: 'title', name: 'title'},
                    {data: 'callno', name: 'callno'},
                    {data: 'type', name: 'type'},
                    {data: 'is_available', name: 'is_available'}
                ],
                responsive: true,  "autoWidth": false,
                buttons: ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        sendRequest();
        function sendRequest(){
            $.ajax({
                url: '{{ route('Penalty.create') }}',
                success:
                function(data){
                $('#listposts').html(data); //insert text of test.php into your div

                },
                complete: function() {
                // Schedule the next request when the current one's complete
                setInterval(sendRequest, 500000); // The interval set to 5 seconds
            }
            });
        }

    });


</script>
