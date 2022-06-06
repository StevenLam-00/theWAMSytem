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
                <h2 class="sub-header">SELECT REVIEWER</h2>
                <?php
                // $select_art = "SELECT * FROM approvedArticle WHERE approvedArticle_id='$_SESSION[approvedArticle_id]'";
                $select_art = "SELECT * FROM approvedArticle";

                $result_art = mysqli_query($conn, $select_art);

                while ($row = mysqli_fetch_assoc($result_art)) {
                    $approvedArticle_id = $row['approvedArticle_id'];
                    $reviewer_id = $row['reviewer_id'];

                    $_SESSION['approvedArticle_id'] = $approvedArticle_id;
                    $_SESSION['reviewer_id'] = $reviewer_id;
                }
                ?>
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="apv_art_id" class="col-sm-2 col-form-label">Article ID</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="approvedArticle_id" id="approvedArticle_id"
                                placeholder="Article ID" value="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rv_id" class="col-sm-2 col-form-label">Reviewer ID</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="reviewer_id" id="reviewer_id"
                                placeholder="reviewer_id" value="<?php echo  $_SESSION['reviewer_id'] ?>" required>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary mb-2" name="select_rv-btn">Select Reviewer
                        </button>
                    </div>

                    <?php

                    if (isset($_POST['select_rv-btn'])) {
                        $approvedArticle_id = $_POST['approvedArticle_id'];
                        $reviewer_id = $_POST['reviewer_id'];

                        $sql_update_edit = "UPDATE approvedArticle SET reviewer_id='$reviewer_id' WHERE approvedArticle_id='$approvedArticle_id'";

                        if (mysqli_query($conn, $sql_update_edit)) {
                    ?>
                    <script type="text/javascript">
                    alert("Select Successfully.");
                    window.location = "be_approvedArticle.php";
                    </script>
                    <?php
                        }
                    }
                    ?>
                </form>
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
                            $result_rv = mysqli_query($conn, $list_rv) or die(mysqli_error($conn));

                            while ($row = mysqli_fetch_assoc($result_rv)) {
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
            </div>
        </div>
    </div>
    <script src="<?php echo BASE_URL . 'assets/js/jquery-1.10.2.js' ?>"></script>
    <script src="<?php echo BASE_URL . 'assets/js/bootstrap.js' ?>"></script>
    <script src="<?php echo BASE_URL . 'assets/js/jquery.flexslider.js' ?>"></script>
    <script src="<?php echo BASE_URL . 'assets/js/scrollReveal.js' ?>"></script>
    <script src="<?php echo BASE_URL . 'assets/js/jquery.easing.min.js' ?>"></script>
    <script src="<?php echo BASE_URL . 'assets/js/custom.js' ?>"></script>

</body>

</html>