<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.0
    </div>
    <strong>&copy; 2023 ESSU Tabulation System</strong> All rights reserved.
</footer>
</div>

<!-- Bootstrap JS -->
<script src="./plugins/bootstrap/js/bootstrap.js"></script>
<!-- JQuery JS -->
<script src="./plugins/jquery/jquery.js"></script>
<!-- AdminLTE JS -->
<script src="./plugins/adminlte/js/adminlte.js"></script>
<!-- Font Awesome JS -->
<script src="./plugins/fontawesome/js/all.min.js"></script>
<!-- SweetAlert JS -->
<script src="./plugins/sweetalert/sweetalert.js"></script>
<!-- DataTables  & Plugins -->
<script src="./plugins/datatables/jquery.dataTables.min.js"></script>
<script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="./plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<!-- Custom JS -->
<script>
    $(document).ready(function() {
        $(".btn_logout").click(function() {
            var formData = new FormData();

            formData.append('logout', true);

            $.ajax({
                url: 'server.php',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    location.href = "./";
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        })

        $(".nav-link").click(function() {
            $(this).children(".tab_spinner").removeClass("d-none");
        })

        $(".datatable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            "targets": 'no-sort',
            "bSort": false,
            "order": []
        })
    })
</script>
</body>

</html>