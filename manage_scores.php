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

<?php
$sql_event = "SELECT * FROM `event` WHERE `status` = 'Current'";
$result_event = $conn->query($sql_event);

$row_event = $result_event->fetch_assoc();

$category_id = $row_event["category_id"];

if ($category_id) {
    $sql_category = "SELECT * FROM `categories` WHERE `id` = '" . $category_id . "'";
    $result_category = $conn->query($sql_category);

    $row_category = $result_category->fetch_assoc();

    $category_name = $row_category["name"];
} else {
    $category_name = "None";
}
?>

<!-- Start Main Content -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-lg-6">
                    <h2 class="mt-3">Current Event: <span class="text-primary"><?= isset($category_name) ? $category_name : "None" ?></span></h2>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <?php if ($sql_event) : ?>
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
                                        $sql = "SELECT * FROM `candidates`";
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

                                                        $sql_2 = "SELECT * FROM `scores` WHERE `judge_id` = '" . $_SESSION["id"] . "' AND `candidate_id` = '" . $row["id"] . "' AND `category_id` = '". $category_id ."'";
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
                                                        <button class="btn btn-success btn-sm btn_set_score" candidate_id="<?= $row["id"] ?>" candidate_name="<?= $row["name"] ?>" category_id="<?= $category_id ?>" category_name="<?= $category_name ?>" judge_id="<?= $_SESSION["id"] ?>" <?= $had_score ? "disabled" : null ?>>
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
                <?php else : ?>
                    <div class="col-lg-12">
                        <h3 class="text-muted">Cannot Vote Yet</h3>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </section>
</div>
<!-- End Main Content -->

<?php include_once "footer.php" ?>