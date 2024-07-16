<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 </strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
    </div>
</footer>
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- jQuery -->
<script src="{{secure_asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{secure_asset('backend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)

</script>
<!-- Bootstrap 4 -->
<script src="{{secure_asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{secure_asset('backend/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{secure_asset('backend/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{secure_asset('backend/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{secure_asset('backend/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{secure_asset('backend/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{secure_asset('backend/plugins/moment/moment.min.js')}}"></script>
<script src="{{secure_asset('backend/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{secure_asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{secure_asset('backend/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{secure_asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{secure_asset('backend/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{secure_asset('backend/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{secure_asset('backend/js/pages/dashboard.js')}}"></script>

<!-- Data Talbe -->
<script src="{{secure_asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{secure_asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{secure_asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{secure_asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{secure_asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{secure_asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{secure_asset('backend/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{secure_asset('backend/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{secure_asset('backend/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{secure_asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{secure_asset('backend/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{secure_asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- switch button  -->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>
    $(function() {
        $("#dataTable").DataTable({
            "responsive": true
            , "lengthChange": false
            , "autoWidth": false
            , "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');

        $('#example').DataTable({
                    "paging": false,
                    "searching": false,
                    "ordering": false
                });
    });

</script>
@yield('scripts')

{{-- hide notifcations after 4 second --}}
<script>
    setTimeout(function() {
        $('#alert').slideUp();
    }, 4000);
</script>
