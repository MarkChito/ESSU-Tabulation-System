<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SESSION["user_type"] != "admin") {
    http_response_code(403);
    exit();
}
?>

<?php include_once "header.php" ?>

<!-- Start Main Content -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-lg-6">
                    <h2 class="mt-3">Manage Candidates</h2>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary mt-3 float-right px-3" data-toggle="modal" data-target="#new_candidate_modal">
                        <i class="fas fa-plus mr-1"></i>
                        New Candidate
                    </button>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Birthday</th>
                                        <th>Sex</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM `candidates` ORDER BY `name` ASC";
                                    $result = $conn->query($sql);
                                    ?>
                                    <?php if ($result->num_rows > 0) : ?>
                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?= $row["name"] ?></td>
                                                <td><?= $row["mobile_number"] ?></td>
                                                <td>
                                                    <?php
                                                    $dateString = $row["birthday"];
                                                    $date = new DateTime($dateString);

                                                    echo $date->format('F j, Y');
                                                    ?>
                                                </td>
                                                <td><?= $row["sex"] ?></td>
                                                <td><?= $row["address"] ?></td>
                                            </tr>
                                        <?php endwhile ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- End Main Content -->

<?php include_once "footer.php" ?>