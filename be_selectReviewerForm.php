<?php
session_start();
include("path.php");
include(ROOT_PATH . "/controllers/researcherController.php");

require 'config/db.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board Editor | Dashboard</title>
    <link href="<?php echo BASE_URL . 'assets/css/bootstrap.css' ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/dashboard.css' ?>">
    <link href="<?php echo BASE_URL . 'assets/css/font-awesome.min.css' ?>" rel=" stylesheet" />
</head>

<body>

    <nav class=" navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Board Editor | Dashboard</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <a class="navbar-brand">Welcome, <?php echo $_SESSION['fullname']; ?> </a>
                    <li><a href="signIn.php" class="logout">LOG OUT</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li><a href="<?php echo BASE_URL . 'be_dashboard.php' ?>">
                            Appraise Article</a></li>
                    <li><a href="<?php echo BASE_URL . 'be_profile.php' ?>">Profile</a></li>
                    <li class="active"><a href="<?php echo BASE_URL . 'be_selectReviewer.php' ?>">Select Reviewer</a>
                    </li>
                    <li><a href="<?php echo BASE_URL . 'be_approvedArticle.php' ?>">
                            Approved Article</a></li>
                    <li><a href="<?php echo BASE_URL . 'be_rejectedArticle.php' ?>">
                            Rejected Article</a></li>
                </ul>
            </div>
            <!-- EDIT FORM  -->
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <!-- LIST ARTICLE -->
                <h2 class="sub-header">Articles Under Review</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Sbm By</th>
                                <th>File Name</th>
                                <th>Division</th>
                                <th>Reviewer</th>
                                <th>Date Submit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = 'SELECT * FROM approvedArticle';
                            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>' . $row['approvedArticle_id'] . '</td>';
                                echo '<td>' . $row['title'] . '</td>';
                                echo '<td>' . $row['sbm_by_user'] . '</td>';
                                echo '<td>' . $row['article_file'] . '</td>';
                                echo '<td>' . $row['division_article'] . '</td>';
                                echo '<td>' . $row[''] . '</td>';

                                echo '<td>' . $row['created_date'] . '</td>';
                                echo '</tr> ';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- LIST REVIEWERS -->
                <h2 class="sub-header">List of Reviewers</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Division</th>
                                <th>Academic Rank</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $list_rv = 'SELECT * FROM users WHERE role = ' . "'reviewer'";
                            $result = mysqli_query($conn, $list_rv) or die(mysqli_error($conn));

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>' . $row['id'] . '</td>';
                                echo '<td>' . $row['fullname'] . '</td>';
                                echo '<td>' . $row['division'] . '</td>';
                                echo '<td>' . $row['academicRank'] . '</td>';
                                echo '</tr> ';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <h2 class="sub-header">Select Reviewers</h2>
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="reviewer" class="col-sm-2 col-form-label">Reviewer ID:</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="selectReviewer">
                                <?php
                                $list_rv = 'SELECT * FROM users WHERE role = ' . "'reviewer'";
                                $result_rv = mysqli_query($conn, $list_rv) or die(mysqli_error($conn));

                                while ($row = mysqli_fetch_assoc($result_rv)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['id'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reviewer" class="col-sm-2 col-form-label">Article Title:</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="selectArticle">
                                <?php
                                $list_art = "SELECT * FROM approvedArticle";
                                $result_art = mysqli_query($conn, $list_art) or die(mysqli_error($conn));

                                while ($row = mysqli_fetch_assoc($result_art)) {
                                    echo '<option value="' . $row['approvedArticle_id'] . '">' . $row['approvedArticle_id'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mb-2" name="select-rv">Select Reviewer</button>
                    </div>
                </form>
                <?php

                if (isset($_POST['select-rv"'])) {
                    $select_rv = $_POST['selectReviewer'];
                    $select_art = $_POST['selectArticle'];
                    $insert_info = "INSERT INTO reviewedArticle (article_id, reviewer_id) VALUES ('$select_art', '$select_rv')";
                    $result = mysqli_query($conn, $insert_info) or die(mysqli_error($conn));
                    if ($result) {
                        echo '<script>alert("Reviewer has been selected")</script>';
                    } else {
                        echo '<script>alert("Reviewer has not been selected")</script>';
                    }
                } ?>

            </div>
        </div>
    </div>
    <script src="<?php echo BASE_URL . 'assets/js/jquery-1.10.2.js' ?>"></script>
    <script src="<?php echo BASE_URL . 'assets/js/bootstrap.js' ?>"></script>
    <script src="<?php echo BASE_URL . 'assets/js/jquery.flexslider.js' ?>"></script>
    <script src="<?php echo BASE_URL . 'assets/js/scrollReveal.js' ?>"></script>
    <script src="<?php echo BASE_URL . 'assets/js/jquery.easing.min.js' ?>"></script>
    <script src="<?php echo BASE_URL . 'assets/js/custom.js' ?>"></script>
    </div>
</body>

</html>