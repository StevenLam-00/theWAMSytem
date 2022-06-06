<?php
include("path.php");
require 'config/db.php';
include(ROOT_PATH . "/controllers/authController.php");

session_start();
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
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Board Editor | Dashboard</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <a class="navbar-brand">Welcome, <?php echo $_SESSION['fullname']; ?> </a>
                    <li><a href="index.php" class="logout">LOG OUT</a></li>
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
                    <li><a href="<?php echo BASE_URL . 'be_selectReviewer.php' ?>">Select Reviewer</a></li>
                    <li><a href="<?php echo BASE_URL . 'be_approvedArticle.php' ?>">
                            Approved Article</a></li>
                    <li class="active"><a href="<?php echo BASE_URL . 'be_rejectedArticle.php' ?>">
                            Rejected Article</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h2 class="sub-header">Rejected Comment</h2>
                <?php
                $sql_comment = "SELECT * FROM rejectArticle WHERE rejectedArticle_id='$_SESSION[rejectedArticle_id]'";
                $result = mysqli_query($conn, $sql_comment);

                while ($row = mysqli_fetch_assoc($result)) {
                    $rejectedArticle_id = $row['rejectedArticle_id'];
                    $title = $row['title'];
                    $message_be = $row['message_be'];


                    $_SESSION['rejectedArticle_id'] = $rejectedArticle_id;
                    $_SESSION['title'] = $title;
                    $_SESSION['message_be'] = $message_be;
                }
                ?>
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="rj_art_id" class="col-sm-2 col-form-label">Rejected Article ID</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="rejectedArticle_id" id="rejectedArticle_id"
                                placeholder="ID" value=" <?php echo  $_SESSION['rejectedArticle_id'] ?> " required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Rejected Article's Title</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="title" id="title" placeholder="Title"
                                value=" <?php echo  $_SESSION['title'] ?> " required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rejectedArticle-msg" class="col-sm-2 col-form-label">Rejected Comment</label>

                        <div class="col-sm-5">
                            <textarea max="1000" class="form-control" placeholder="Comment" name="message_be"
                                value="<?php echo  $_SESSION['message_be'] ?>" id="message_be"></textarea>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary mb-2" name="update-btn">Update Comment
                        </button>
                    </div>

                    <?php

                    if (isset($_POST['update-btn'])) {
                        $rejectedArticle_id = $_POST['rejectedArticle_id'];
                        $message_be = $_POST['message_be'];

                        $sql_update_edit = "UPDATE rejectedArticle SET message_be='$message_be' WHERE rejectedArticle_id='" . $_SESSION['rejectedArticle_id'] . "';";

                        if (mysqli_query($conn, $sql_update_edit)) {
                    ?>
                    <script type="text/javascript">
                    alert("Comment Successfully.");
                    window.location = "be_rejectedArticle.php";
                    </script>
                    <?php
                        }
                    }
                    ?>
                </form>
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