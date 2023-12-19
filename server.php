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
            $user_name = $row["name"];
            $user_type = $row["user_type"];
            $hashed_password = $row["password"];
        }

        if (password_verify($password, $hashed_password)) {
            $_SESSION['id'] = $user_id;
            $_SESSION['name'] = $user_name;
            $_SESSION['user_type'] = $user_type;

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

if (isset($_POST["dashboard"])) {
    $_SESSION["current_tab"] = "Dashboard";

    echo json_encode(true);
}

if (isset($_POST["judges_scores"])) {
    $_SESSION["current_tab"] = "Judges Scores";

    echo json_encode(true);
}

if (isset($_POST["manage_judges"])) {
    $_SESSION["current_tab"] = "Manage Judges";

    echo json_encode(true);
}

if (isset($_POST["manage_candidates"])) {
    $_SESSION["current_tab"] = "Manage Candidates";

    echo json_encode(true);
}

if (isset($_POST["manage_scores"])) {
    $_SESSION["current_tab"] = "Manage Scores";

    echo json_encode(true);
}

if (isset($_POST["new_judge"])) {
    $name = $_POST["name"];
    $mobile_number = $_POST["mobile_number"];
    $birthday = $_POST["birthday"];
    $sex = $_POST["sex"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM `users` WHERE `username` = '" . $username . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode(false);
    } else {
        $sql = "INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_type`) VALUES (NULL, '" . $name . "', '" . $username . "', '" . password_hash($password, PASSWORD_BCRYPT) . "', 'judge')";
        $conn->query($sql);

        $sql = "SELECT * FROM `users` WHERE `username` = '" . $username . "'";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $user_id = $row["id"];
        }

        $sql = "INSERT INTO `judges` (`id`, `user_id`, `name`, `mobile_number`, `birthday`, `sex`) VALUES (NULL, '" . $user_id . "', '" . $name . "', '" . $mobile_number . "', '" . $birthday . "', '" . $sex . "')";
        $conn->query($sql);

        $_SESSION["alert"] =  array(
            "title" => "Success!",
            "message" => "A judge is added successfully!",
            "type" => "success"
        );

        echo json_encode(true);
    }
}

if (isset($_POST["new_candidate"])) {
    $name = $_POST["name"];
    $mobile_number = $_POST["mobile_number"];
    $birthday = $_POST["birthday"];
    $sex = $_POST["sex"];
    $address = $_POST["address"];

    $sql = "INSERT INTO `candidates` (`id`, `name`, `mobile_number`, `birthday`, `sex`, `address`) VALUES (NULL, '" . $name . "', '" . $mobile_number . "', '" . $birthday . "', '" . $sex . "', '" . $address . "')";
    $conn->query($sql);

    $_SESSION["alert"] =  array(
        "title" => "Success!",
        "message" => "A candidate is added successfully!",
        "type" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["set_score"])) {
    $candidate_id = $_POST["candidate_id"];
    $judge_id = $_POST["judge_id"];
    $category_id = $_POST["category_id"];
    $score = $_POST["score"];

    $sql = "INSERT INTO `scores` (`id`, `judge_id`, `candidate_id`, `category_id`, `score`) VALUES (NULL, '" . $judge_id . "', '" . $candidate_id . "', '" . $category_id . "', '" . $score . "')";
    $conn->query($sql);

    $_SESSION["alert"] =  array(
        "title" => "Success!",
        "message" => "A candidate has been scored successfully!",
        "type" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["start_event"])) {
    $sql_1 = "UPDATE `event` SET `status` = 'Pending'";
    $conn->query($sql_1);

    $sql_2 = "TRUNCATE TABLE `scores`";
    $conn->query($sql_2);

    $sql_3 = "UPDATE `event` SET `status` = 'Current' ORDER BY id LIMIT 1";
    $conn->query($sql_3);

    $_SESSION["alert"] =  array(
        "title" => "Success!",
        "message" => "The current event has been updated!",
        "type" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["change_next_event"])) {
    $sql_1 = "SELECT * FROM `event` WHERE `status` = 'Current'";
    $conn->query($sql_1);

    $sql_2 = "UPDATE `event` SET `status` = 'Current' WHERE `id` = (SELECT MIN(`id`) FROM `event` WHERE `id` > (SELECT MAX(`id`) FROM `event` WHERE `status` = 'Current') AND `status` = 'Pending')";
    $conn->query($sql_2);

    $sql_3 = "UPDATE `event` SET `status` = 'Done' WHERE `status` = 'Current' LIMIT 1";
    $conn->query($sql_3);

    $_SESSION["alert"] =  array(
        "title" => "Success!",
        "message" => "The current event has been updated!",
        "type" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["stop_event"])) {
    $sql = "UPDATE `event` SET `status` = 'Done' WHERE `status` = 'Current'";
    $conn->query($sql);

    $_SESSION["alert"] =  array(
        "title" => "Success!",
        "message" => "The current event has been updated!",
        "type" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["logout"])) {
    unset($_SESSION["id"]);

    echo json_encode(true);
}
