<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SESSION["user_type"] != "judge") {
    http_response_code(403);
    exit();
}
?>

<?php include_once "header.php" ?>

<!-- Start Main Content -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-3">Manage Scores</h2>
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
                                        <th>Candidate Name</th>
                                        <th>Sex</th>
                                        <th>Score</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM `candidates` ORDER BY CASE WHEN `sex` = 'Male' THEN 1 ELSE 2 END, `name` ASC";
                                    $result = $conn->query($sql);
                                    ?>
                                    <?php if ($result->num_rows > 0) : ?>
                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?= $row["name"] ?></td>
                                                <td><?= $row["sex"] ?></td>
                                                <td>
                                                    <?php
                                                    $had_score = false;

                                                    $sql_2 = "SELECT * FROM `scores` WHERE `judge_id` = '" . $_SESSION["id"] . "' AND `candidate_id` = '" . $row["id"] . "'";
                                                    $result_2 = $conn->query($sql_2);

                                                    if ($result_2->num_rows > 0) {
                                                        while ($row_2 = $result_2->fetch_assoc()) {
                                                            $score = $row_2["score"];
                                        
                                                            echo number_format((float)$score, 8, '.', '');
                                                        }

                                                        $had_score = true;
                                                    } else {
                                                        echo "0";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-success btn-sm btn_set_score" candidate_id="<?= $row["id"] ?>" candidate_name="<?= $row["name"] ?>" judge_id="<?= $_SESSION["id"] ?>" <?= $had_score ? "disabled" : null ?>>
                                                        <i class="fas fa-edit"></i>
                                                        Set Score
                                                    </button>
                                                </td>
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