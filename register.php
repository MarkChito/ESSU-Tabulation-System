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

    <title>Tabulation System</title>

    <link rel="shortcut icon" href="./assets/img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="./plugins/bootstrap-5.0.2-dist/css/bootstrap.css">
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
                    <p class="text-center mb-0">Please <b>Register</b> to proceed</p>
                    <div class="card-body">
                        <form action="server.php" method="post" id="register_form">
                            <div class="form-group mb-3">
                                <label for="register_name">Name</label>
                                <input type="text" class="form-control" id="register_name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="register_username">Username</label>
                                <input type="text" class="form-control" id="register_username" required>
                                <small class="text-danger d-none" id="error_register_username">Username already exists</small>
                            </div>
                            <div class="form-group mb-3">
                                <label for="register_password">Password</label>
                                <input type="password" class="form-control" id="register_password" required>
                                <small class="text-danger d-none" id="error_register_password">Password do not match</small>
                            </div>
                            <div class="form-group mb-3">
                                <label for="register_confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="register_confirm_password" required>
                            </div>

                            <button class="btn btn-primary w-100" id="register">Register</button>
                        </form>

                        <div class="mt-3">
                            <span>Already had an Account?</span>
                            <a href="./" style="text-decoration: none;">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./plugins/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
    <script src="./plugins/jquery/jquery.js"></script>

    <script>
        $(document).ready(function() {
            $("#register_form").submit(function(e) {
                e.preventDefault();

                var password = $("#register_password").val();
                var confirm_password = $("#register_confirm_password").val();

                if (validate_password(password, confirm_password)) {
                    var formData = new FormData();

                    formData.append('register', true);

                    $.ajax({
                        url: 'server.php',
                        data: formData,
                        type: 'POST',
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response) {
                                location.href = "./register";
                            } else {
                                $("#error_register_username").removeClass("d-none");
                                $("#register_username").addClass("is-invalid");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    $("#register_password").addClass("is-invalid");
                    $("#register_confirm_password").addClass("is-invalid");
                    $("#error_register_password").removeClass("d-none");
                }
            })

            $("#register_password").keypress(function() {
                $("#register_password").removeClass("is-invalid");
                $("#register_confirm_password").removeClass("is-invalid");
                $("#error_register_password").addClass("d-none");
            })

            $("#register_confirm_password").keypress(function() {
                $("#register_password").removeClass("is-invalid");
                $("#register_confirm_password").removeClass("is-invalid");
                $("#error_register_password").addClass("d-none");
            })

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

<?php unset($_SESSION["login_status"]) ?>