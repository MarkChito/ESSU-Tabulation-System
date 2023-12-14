<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["id"])) {
    if ($_SESSION["user_type"] == "admin") {
        $_SESSION["current_tab"] = "Dashboard";

        header("location: dashboard.php");
    } else {
        $_SESSION["current_tab"] = "Manage Scores";

        header("location: manage_scores.php");
    }
} else {
    header("location: login.php");
}
