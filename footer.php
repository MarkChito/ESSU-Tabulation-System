<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.0
    </div>
    <strong>&copy; 2023 ESSU Tabulation System</strong> All rights reserved.
</footer>
</div>

<!-- New Judge Modal -->
<div class="modal fade" id="new_judge_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Judge</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" id="new_judge_form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="new_judge_name">Name</label>
                                <input type="text" class="form-control" id="new_judge_name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="new_judge_mobile_number">Mobile Number</label>
                                <input type="number" class="form-control" id="new_judge_mobile_number" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="new_judge_birthday">Birthday</label>
                                <input type="date" class="form-control" id="new_judge_birthday" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="new_judge_sex">Sex</label>
                                <select class="custom-select" id="new_judge_sex" required>
                                    <option value disabled selected>Choose...</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_judge_username">Username</label>
                        <input type="text" class="form-control" id="new_judge_username" required>
                        <small class="text-danger d-none" id="error_new_judge_username">Username already exists</small>
                    </div>
                    <div class="form-group">
                        <label for="new_judge_password">Password</label>
                        <input type="password" class="form-control" id="new_judge_password" required>
                        <small class="text-danger d-none" id="error_new_judge_password">Password do not match</small>
                    </div>
                    <div class="form-group">
                        <label for="new_judge_confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" id="new_judge_confirm_password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="new_judge_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- New Candidate Modal -->
<div class="modal fade" id="new_candidate_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Candidate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" id="new_candidate_form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="new_candidate_name">Name</label>
                                <input type="text" class="form-control" id="new_candidate_name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="new_candidate_mobile_number">Mobile Number</label>
                                <input type="number" class="form-control" id="new_candidate_mobile_number" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="new_candidate_birthday">Birthday</label>
                                <input type="date" class="form-control" id="new_candidate_birthday" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="new_candidate_sex">Sex</label>
                                <select class="custom-select" id="new_candidate_sex" required>
                                    <option value disabled selected>Choose...</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_candidate_address">Address</label>
                        <textarea id="new_candidate_address" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="new_candidate_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Set Score -->
<div class="modal fade" id="set_score_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Set Score</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" id="set_score_form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="set_score_candidate_name">Candidate Name</label>
                        <input type="text" id="set_score_candidate_name" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="set_score_score">Score</label>
                        <input type="number" id="set_score_score" class="form-control" step="any" required>
                        <small class="text-danger d-none" id="error_set_score_score">Invalid Score</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="set_score_candidate_id">
                    <input type="hidden" id="set_score_judge_id">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="set_score_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JQuery JS -->
<script src="./plugins/jquery/jquery.js"></script>
<!-- Bootstrap JS -->
<!-- <script src="./plugins/bootstrap/js/bootstrap.min.js"></script> -->
<script src="./plugins/bootstrap/js/new_bootstrap.min.js"></script>
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
        var alert = <?= isset($_SESSION["alert"]) ? json_encode($_SESSION["alert"]) : json_encode(null) ?>;

        if (alert) {
            sweet_alert(alert);
        }

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

        $("#btn_dashboard").click(function() {
            var formData = new FormData();

            formData.append('dashboard', true);

            $.ajax({
                url: 'server.php',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    location.href = "./"
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        })

        $("#btn_manage_judges").click(function() {
            var formData = new FormData();

            formData.append('manage_judges', true);

            $.ajax({
                url: 'server.php',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    location.href = "./manage_judges.php"
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        })

        $("#btn_manage_candidates").click(function() {
            var formData = new FormData();

            formData.append('manage_candidates', true);

            $.ajax({
                url: 'server.php',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    location.href = "./manage_candidates.php"
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        })

        $("#btn_manage_scores").click(function() {
            var formData = new FormData();

            formData.append('manage_scores', true);

            $.ajax({
                url: 'server.php',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    location.href = "./manage_scores.php"
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        })

        $("#new_judge_form").submit(function() {
            var name = $("#new_judge_name").val();
            var mobile_number = $("#new_judge_mobile_number").val();
            var birthday = $("#new_judge_birthday").val();
            var sex = $("#new_judge_sex").val();
            var username = $("#new_judge_username").val();
            var password = $("#new_judge_password").val();
            var confirm_password = $("#new_judge_confirm_password").val();

            if (validate_password(password, confirm_password)) {
                $("#new_judge_submit").attr("disabled", true);
                $("#new_judge_submit").text("Processing...");

                var formData = new FormData();

                formData.append('name', name);
                formData.append('mobile_number', mobile_number);
                formData.append('birthday', birthday);
                formData.append('sex', sex);
                formData.append('username', username);
                formData.append('password', password);
                formData.append('new_judge', true);

                $.ajax({
                    url: 'server.php',
                    data: formData,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response) {
                            location.href = "./manage_judges.php";
                        } else {
                            $("#new_judge_username").addClass("is-invalid");
                            $("#error_new_judge_username").removeClass("d-none");

                            $("#new_judge_submit").removeAttr("disabled");
                            $("#new_judge_submit").text("Submit");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                $("#error_new_judge_password").removeClass("d-none");
                $("#new_judge_password").addClass("is-invalid");
                $("#new_judge_confirm_password").addClass("is-invalid");
            }
        })

        $("#new_judge_password").keypress(function() {
            $("#error_new_judge_password").addClass("d-none");
            $("#new_judge_password").removeClass("is-invalid");
            $("#new_judge_confirm_password").removeClass("is-invalid");
        })

        $("#new_judge_confirm_password").keypress(function() {
            $("#error_new_judge_password").addClass("d-none");
            $("#new_judge_password").removeClass("is-invalid");
            $("#new_judge_confirm_password").removeClass("is-invalid");
        })

        $("#new_judge_username").keypress(function() {
            $("#error_new_judge_username").addClass("d-none");
            $("#new_judge_username").removeClass("is-invalid");
        })

        $("#new_candidate_form").submit(function() {
            var name = $("#new_candidate_name").val();
            var mobile_number = $("#new_candidate_mobile_number").val();
            var birthday = $("#new_candidate_birthday").val();
            var sex = $("#new_candidate_sex").val();
            var address = $("#new_candidate_address").val();

            $("#new_candidate_submit").attr("disabled", true);
            $("#new_candidate_submit").text("Processing...");

            var formData = new FormData();

            formData.append('name', name);
            formData.append('mobile_number', mobile_number);
            formData.append('birthday', birthday);
            formData.append('sex', sex);
            formData.append('address', address);
            formData.append('new_candidate', true);

            $.ajax({
                url: 'server.php',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    location.href = "./manage_candidates.php";
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        })

        $(".btn_set_score").click(function() {
            var candidate_id = $(this).attr("candidate_id");
            var candidate_name = $(this).attr("candidate_name");
            var judge_id = $(this).attr("judge_id");

            $("#set_score_candidate_name").val(candidate_name);
            $("#set_score_candidate_id").val(candidate_id);
            $("#set_score_judge_id").val(judge_id);

            $("#set_score_modal").modal().show();
        })

        $("#set_score_form").submit(function() {
            var candidate_id = $("#set_score_candidate_id").val();
            var judge_id = $("#set_score_judge_id").val();
            var score = $("#set_score_score").val();

            if (score > 100 || score <= 0) {
                $("#error_set_score_score").removeClass("d-none");
                $("#set_score_score").addClass("is-invalid");
            } else {
                $("#set_score_submit").attr("disabled", true);
                $("#set_score_submit").text("Processing...");

                var formData = new FormData();
                
                formData.append('candidate_id', candidate_id);
                formData.append('judge_id', judge_id);
                formData.append('score', score);
                formData.append('set_score', true);
                
                $.ajax({
                    url: 'server.php',
                    data: formData,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        location.href = "./manage_scores.php"
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        })

        $("#set_score_score").keypress(function() {
            $("#error_set_score_score").addClass("d-none");
            $("#set_score_score").removeClass("is-invalid");
        })

        function sweet_alert(alert) {
            Swal.fire({
                title: alert.title,
                text: alert.message,
                icon: alert.type
            });
        }

        function validate_password(password, confirm_password) {
            if (password == confirm_password) {
                return true;
            } else {
                return false;
            }
        }
    })
</script>
</body>

</html>

<?php unset($_SESSION["alert"]) ?>