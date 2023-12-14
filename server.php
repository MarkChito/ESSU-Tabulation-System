<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('Asia/Manila');

$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "essu_tabulation_system";

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM `users` WHERE `username` = '" . $username . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user_id = $row["id"];
            $hashed_password = $row["password"];
        }

        if (password_verify($password, $hashed_password)) {
            $_SESSION['id'] = $user_id;

            $currentDateTime = time();

            $date = date("F j, Y", $currentDateTime);
            $time = date("h:i A", $currentDateTime);

            $sql_2 = "INSERT INTO `logs` (`id`, `user_id`, `date`, `time`) VALUES (NULL, '" . $user_id . "', '" . $date . "', '" . $time . "')";
            $result_2 = $conn->query($sql_2);
        } else {
            $_SESSION['login_status'] = array(
                'type' => 'danger',
                'message' => 'Invalid Username or Password'
            );
        }
    } else {
        $_SESSION['login_status'] = array(
            'type' => 'danger',
            'message' => 'Invalid Username or Password'
        );
    }

    $conn->close();

    echo json_encode(true);
}

if (isset($_POST["register"])) {
    echo json_encode(false);
}

if (isset($_POST["logout"])) {
    unset($_SESSION["id"]);

    echo json_encode(true);
}
