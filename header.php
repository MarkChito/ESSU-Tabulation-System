<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["id"])) {
    $_SESSION['login_status'] = array(
        'type' => 'danger',
        'message' => 'You must login first'
    );

    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tabulation System<?= " - " . $_SESSION["current_tab"] ?></title>

    <link rel="shortcut icon" href="./assets/img/favicon.ico" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./plugins/bootstrap/css/bootstrap.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="./plugins/adminlte/css/adminlte.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a class="dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="./assets/img/default_user.png" class="img-circle elevation-2 me-1" alt="User Image" width="32" height="32">
                        <span class="d-none d-md-inline text-bold">Administrator</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="javascript:void(0)"><i class="fas fa-user me-3"></i> Account</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)"><i class="fas fa-code me-3"></i>Developers</a></li>
                        <li><a class="dropdown-item btn_logout" href="javascript:void(0)"><i class="fas fa-sign-out-alt me-3"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <div class="sidebar">
                <div class="user-panel mt-3 pb-2 mb-3 d-flex">
                    <div class="image">
                        <img src="./assets/img/logo.png" class="img-circle elevation-2" alt="Header Image">
                    </div>
                    <div class="info">
                        <h5 class="d-block text-white text-bold">Tabulation System</h5>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="javascript:void(0)" id="btn_dashboard" class="nav-link <?= $_SESSION["current_tab"] == "Dashboard" ? "active" : null ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                                <div class="spinner-border spinner-border-sm text-success float-right d-none tab_spinner" role="status"></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="404.php" class="nav-link">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>Manage Judges</p>
                                <div class="spinner-border spinner-border-sm text-success float-right d-none tab_spinner" role="status"></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="404.php" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Manage Candidates</p>
                                <div class="spinner-border spinner-border-sm text-success float-right d-none tab_spinner" role="status"></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="404.php" class="nav-link">
                                <i class="nav-icon fas fa-poll"></i>
                                <p>Manage Scores</p>
                                <div class="spinner-border spinner-border-sm text-success float-right d-none tab_spinner" role="status"></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link btn_logout">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                                <div class="spinner-border spinner-border-sm text-success float-right d-none tab_spinner" role="status"></div>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>