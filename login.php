<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tabulation System - Login</title>

    <link rel="shortcut icon" href="./assets/img/favicon.ico" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./plugins/bootstrap/css/bootstrap.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">

    <style>
        body {
            background-image: url("./assets/img/bg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="login-form">
        <div class="d-flex h-100 align-items-center justify-content-center">
            <div class="card-login-form">
                <?php if (isset($_SESSION["login_status"])) : ?>
                    <div class="alert alert-<?= $_SESSION["login_status"]["type"] ?> text-center">
                        <?= $_SESSION["login_status"]["message"] ?>
                    </div>
                <?php endif ?>
                <div class="card">
                    <div class="text-center">
                        <img src="./assets/img/logo.png" style="width: 200px; height: 200px; padding: 16px">

                        <h3 class="text-success">Eastern Samar State University</h3>
                        <h1 class="text-success">Tabulation System</h1>
                    </div>
                    <hr>
                    <p class="text-center mb-0">Please login to proceed</p>
                    <div class="card-body">
                        <form action="javascript:void(0)" id="login_form">
                            <div class="form-group mb-3">
                                <label for="login_username">Username</label>
                                <input type="text" class="form-control" id="login_username" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="login_password">Password</label>
                                <input type="password" class="form-control" id="login_password" required>
                            </div>

                            <button class="btn btn-primary w-100" id="login">Login</button>
                        </form>

                        <div class="mt-3">
                            <span>Forgot your Account?</span>
                            <a href="javascript:void(0)" style="text-decoration: none;" id="btn_reset">Reset your Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="./plugins/bootstrap/js/bootstrap.js"></script>
    <!-- JQuery JS -->
    <script src="./plugins/jquery/jquery.js"></script>
    <!-- Font Awesome JS -->
    <script src="./plugins/fontawesome/js/all.min.js"></script>
    <!-- SweetAlert JS -->
    <script src="./plugins/sweetalert/sweetalert.js"></script>
    <!-- Custom JS -->
    <script>
        $(document).ready(function() {
            $("#login_form").submit(function() {
                $("#login_username").attr("disabled", true);
                $("#login_password").attr("disabled", true);

                $("#login").attr("disabled", true);
                $("#login").text("Processing Request...");

                var formData = new FormData();

                formData.append('login', true);
                formData.append("username", $("#login_username").val());
                formData.append("password", $("#login_password").val());

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

            $("#btn_reset").click(function() {
                Swal.fire({
                    title: "Oops...",
                    text: "Please contact your system developer!",
                    icon: "error"
                });
            })
        })
    </script>
</body>

</html>

<?php unset($_SESSION["login_status"]) ?>