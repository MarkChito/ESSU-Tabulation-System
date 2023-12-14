<?php include_once "header.php" ?>

<!-- Start Main Content -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-3">Manage Judges</h2>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary mt-3 float-right px-3" data-toggle="modal" data-target="#new_judge_modal">
                        <i class="fas fa-plus mr-1"></i>
                        New Judge
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
                                        <th>Username</th>
                                        <th>Password</th>
                                        <!-- <th class="text-center">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM `judges` ORDER BY `name` ASC";
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
                                                <td>
                                                    <?php
                                                    $sql_2 = "SELECT * FROM `users` WHERE `id` = '" . $row["user_id"] . "'";
                                                    $result_2 = $conn->query($sql_2);

                                                    while ($row_2 = $result_2->fetch_assoc()) {
                                                        echo $row_2["username"];
                                                    }
                                                    ?>
                                                </td>
                                                <td>********************</td>
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