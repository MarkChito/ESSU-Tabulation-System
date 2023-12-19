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

<?php
// Assuming $conn is your database connection
$sql_judges = "SELECT * FROM `judges`";
$result_judges = $conn->query($sql_judges);
?>

<!-- Start Main Content -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-lg-6">
                    <h2 class="mt-3" id="test">Judges Scores</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <?php if ($result_judges->num_rows > 0) : ?>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="sticky-top">
                                    <?php $key = 0 ?>
                                    <?php while ($row_judges = $result_judges->fetch_assoc()) : ?>
                                        <button class="btn btn-link judge-btn <?= $key == 0 ? 'font-weight-bold' : '' ?>" type="button" data-toggle="collapse" data-target="#judge<?= $row_judges["user_id"] ?>">
                                            <?= $row_judges["name"] ?>
                                        </button>
                                        <?php $key++ ?>
                                    <?php endwhile ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php
                                        $result_judges = $conn->query($sql_judges); // Re-executing the query
                                        ?>
                                        <?php if ($result_judges->num_rows > 0) : ?>
                                            <?php $key_2 = 0 ?>
                                            <?php while ($row_judges = $result_judges->fetch_assoc()) : ?>
                                                <div class="collapse <?= $key_2 == 0 ? 'show' : '' ?>" id="judge<?= $row_judges["user_id"] ?>">
                                                    <table class="table table-hover datatable">
                                                        <thead>
                                                            <tr>
                                                                <th>Candidate Name</th>
                                                                <?php
                                                                $sql_categories = "SELECT * FROM `categories`";
                                                                $result_categories = $conn->query($sql_categories);
                                                                ?>
                                                                <?php if ($result_categories->num_rows > 0) : ?>
                                                                    <?php while ($row_categories = $result_categories->fetch_assoc()) : ?>
                                                                        <th class="text-center"><?= $row_categories["name"] ?></th>
                                                                    <?php endwhile ?>
                                                                <?php endif ?>
                                                                <th class="text-center">Total Score</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $sql_candidates = "SELECT * FROM `candidates`";
                                                            $result_candidates = $conn->query($sql_candidates);
                                                            ?>
                                                            <?php if ($result_candidates->num_rows > 0) : ?>
                                                                <?php while ($row_candidates = $result_candidates->fetch_assoc()) : ?>
                                                                    <tr>
                                                                        <td><?= $row_candidates["name"] ?></td>
                                                                        <?php
                                                                        $total_score = 0;
                                                                        $result_categories = $conn->query($sql_categories); // Re-executing the query
                                                                        ?>
                                                                        <?php if ($result_categories->num_rows > 0) : ?>
                                                                            <?php while ($row_categories = $result_categories->fetch_assoc()) : ?>
                                                                                <?php
                                                                                $sql_scores = "SELECT * FROM `scores` WHERE `judge_id` = '" . $row_judges["user_id"] . "' AND `candidate_id` = '" . $row_candidates["id"] . "' AND `category_id` = '" . $row_categories["id"] . "'";
                                                                                $result_scores = $conn->query($sql_scores);

                                                                                $row_scores = $result_scores->fetch_assoc();
                                                                                $score_value = $row_scores ? number_format((float)$row_scores["score"], 8, '.', '') : "----------";
                                                                                ?>

                                                                                <td class="text-center"><?= $score_value ?></td>

                                                                                <?php $total_score += $row_scores ? $row_scores["score"] : 0 ?>
                                                                            <?php endwhile ?>
                                                                        <?php endif ?>
                                                                        <td class="text-center"><?= number_format((float)($total_score), 8, '.', '') ?></td>
                                                                    </tr>
                                                                <?php endwhile ?>
                                                            <?php endif ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                
                                                <?php $key_2++ ?>
                                            <?php endwhile ?>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-muted">No Data Available</h3>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </section>
</div>
<!-- End Main Content -->

<?php include_once "footer.php" ?>