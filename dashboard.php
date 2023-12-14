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
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-3">Dashboard</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <?php
                $sql = "SELECT candidate_id, AVG(score) AS total_score FROM `scores` GROUP BY candidate_id ORDER BY total_score DESC";
                $result = $conn->query($sql);

                $maleCandidates = [];
                $femaleCandidates = [];

                if ($result->num_rows > 0) :
                    while ($row = $result->fetch_assoc()) :
                        $sql_2 = "SELECT * FROM `candidates` WHERE `id` = '" . $row["candidate_id"] . "'";
                        $result_2 = $conn->query($sql_2);

                        while ($row_2 = $result_2->fetch_assoc()) {
                            $candidate_name = $row_2["name"];
                            $candidate_sex = $row_2["sex"];
                        }

                        if ($candidate_sex === "Male") {
                            $maleCandidates[] = [
                                'name' => $candidate_name,
                                'sex' => $candidate_sex,
                                'total_score' => number_format($row["total_score"], 8),
                                'weighted_score' => number_format($row["total_score"] * 0.3, 8),
                            ];
                        } elseif ($candidate_sex === "Female") {
                            $femaleCandidates[] = [
                                'name' => $candidate_name,
                                'sex' => $candidate_sex,
                                'total_score' => number_format($row["total_score"], 8),
                                'weighted_score' => number_format($row["total_score"] * 0.3, 8),
                            ];
                        }
                    endwhile;
                endif;
                ?>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                <i class="fas fa-mars-stroke text-primary mr-1"></i>
                                Male Candidates
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>Candidate Name</th>
                                        <th>Sex</th>
                                        <th>Total Score</th>
                                        <th>Rank</th>
                                        <th>Total of 30%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $maleRank = 1;
                                    foreach ($maleCandidates as $maleCandidate) :
                                    ?>
                                        <tr>
                                            <td><?= $maleCandidate['name'] ?></td>
                                            <td><?= $maleCandidate['sex'] ?></td>
                                            <td><?= $maleCandidate['total_score'] ?></td>
                                            <td><?= $maleRank ?></td>
                                            <td><?= $maleCandidate['weighted_score'] ?></td>
                                        </tr>
                                        <?php $maleRank++ ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                <i class="fas fa-venus text-danger mr-1"></i>
                                Female Candidates
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>Candidate Name</th>
                                        <th>Sex</th>
                                        <th>Total Score</th>
                                        <th>Rank</th>
                                        <th>Total of 30%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $femaleRank = 1;
                                    foreach ($femaleCandidates as $femaleCandidate) :
                                    ?>
                                        <tr>
                                            <td><?= $femaleCandidate['name'] ?></td>
                                            <td><?= $femaleCandidate['sex'] ?></td>
                                            <td><?= $femaleCandidate['total_score'] ?></td>
                                            <td><?= $femaleRank ?></td>
                                            <td><?= $femaleCandidate['weighted_score'] ?></td>
                                        </tr>
                                        <?php $femaleRank++ ?>
                                    <?php endforeach; ?>
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