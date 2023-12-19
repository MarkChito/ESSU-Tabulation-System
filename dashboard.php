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
                    <h2 class="mt-3">Dashboard</h2>
                </div>
                <?php
                $sql_event = "SELECT * FROM `event` WHERE `status` = 'Current'";
                $result_event = $conn->query($sql_event);
                ?>
                <div class="col-lg-6">
                    <?php if ($result_event->num_rows > 0) : ?>
                        <?php $row_event = $result_event->fetch_assoc() ?>

                        <?php if ($row_event["category_id"] != "5") : ?>
                            <button class="btn btn-primary mt-3 float-right px-3" id="btn_change_next_event">
                                <i class="fas fa-sync mr-1"></i>
                                Change Event
                            </button>
                        <?php else : ?>
                            <button class="btn btn-primary mt-3 float-right px-3" id="btn_stop_event">
                                <i class="fas fa-play-circle mr-1"></i>
                                Stop Event
                            </button>
                        <?php endif ?>
                    <?php else : ?>
                        <button class="btn btn-primary mt-3 float-right px-3" id="btn_start_event">
                            <i class="fas fa-play-circle mr-1"></i>
                            Start Event
                        </button>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php
                            $category_id = isset($row_event["category_id"]);

                            if ($category_id) {
                                $sql_category = "SELECT * FROM `categories` WHERE `id` = '" . $category_id . "'";
                                $result_category = $conn->query($sql_category);

                                $row_category = $result_category->fetch_assoc();

                                $category_name = $row_category["name"];
                            } else {
                                $category_name = "None";
                            }
                            ?>
                            <h5><?= $category_name ?></h5>

                            <p>Current Event</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <a href="javascript:void(0)" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <?php
                            $sql_leading_male_candidate = "SELECT c.*, SUM(s.score) AS `total_score` FROM `candidates` c INNER JOIN `scores` s ON c.id = s.candidate_id WHERE c.sex = 'Male' GROUP BY c.id, c.name, c.sex ORDER BY `total_score` DESC LIMIT 1";
                            $result_leading_male_candidate = $conn->query($sql_leading_male_candidate);

                            if ($result_leading_male_candidate->num_rows > 0) {
                                $row_leading_male_candidate = $result_leading_male_candidate->fetch_assoc();

                                $leading_male_candidate = $row_leading_male_candidate["name"];
                            } else {
                                $leading_male_candidate = "None";
                            }
                            ?>

                            <h5><?= $leading_male_candidate ?></h5>

                            <p>Leading Male Candidate</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-mars"></i>
                        </div>
                        <a href="javascript:void(0)" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <?php
                            $sql_leading_female_candidate = "SELECT c.*, SUM(s.score) AS `total_score` FROM `candidates` c INNER JOIN `scores` s ON c.id = s.candidate_id WHERE c.sex = 'Female' GROUP BY c.id, c.name, c.sex ORDER BY `total_score` DESC LIMIT 1";
                            $result_leading_female_candidate = $conn->query($sql_leading_female_candidate);

                            if ($result_leading_female_candidate->num_rows > 0) {
                                $row_leading_female_candidate = $result_leading_female_candidate->fetch_assoc();

                                $leading_female_candidate = $row_leading_female_candidate["name"];
                            } else {
                                $leading_female_candidate = "None";
                            }
                            ?>

                            <h5><?= $leading_female_candidate ?></h5>

                            <p>Leading Female Candidate</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-venus"></i>
                        </div>
                        <a href="javascript:void(0)" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <?php
                            $sql_category = "SELECT * FROM `candidates`";
                            $result_category = $conn->query($sql_category);
                            ?>
                            <h5><?= $result_category->num_rows ?></h5>

                            <p>Number of Candidates</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <a href="javascript:void(0)" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
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