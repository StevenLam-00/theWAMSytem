<?php
include("path.php");
require 'config/db.php';

include(ROOT_PATH . "/controllers/authController.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Researcher | Dashboard</title>
    <link href="<?php echo BASE_URL . 'assets/css/bootstrap.css' ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/dashboard.css' ?>">
    <link href="<?php echo BASE_URL . 'assets/css/font-awesome.min.css' ?>" rel=" stylesheet" />
</head>

<body>

    <nav class=" navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Reviewer | Dashboard</a>
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
                    <li class="active"><a href="<?php echo BASE_URL . 'rv_dashboard.php' ?>">
                            Incoming Article</a></li>
                    <li><a href="<?php echo BASE_URL . 'rv_profile.php' ?>">Profile</a></li>
                    <li><a href="<?php echo BASE_URL . 'rv_publishArticle.php' ?>">Publish Article</a></li>
                    <li><a href="<?php echo BASE_URL . 'rv_rejectArticle.php' ?>">Reject Article</a></li>
                </ul>
            </div>

            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Article Under Review</h1>
                <form method="POST" action="">
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $q = mysqli_query($conn, "SELECT * FROM users where username='$_SESSION[login_user]' ;"); ?>
                                <?php
                                $row_id = mysqli_fetch_assoc($q);
                                $_SESSION['login_user'];
                                ?>
                                <?php
                                $query = 'SELECT * FROM approvedArticle';
                                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($row['reviewer_id'] == $row_id['id']) {
                                        $approvedArticle_id = $row['approvedArticle_id'];
                                        $title = $row['title'];
                                        $_SESSION['approvedArticle_id'] = $approvedArticle_id;
                                        $_SESSION['title'] = $title;

                                        echo '<tr>';
                                        echo '<td>' . $row['approvedArticle_id'] . '</td>';
                                        echo '<td>' . $row['title'] . '</td>';
                                        echo '<td>' . $row['sbm_by_user'] . '</td>';
                                        echo '<td>' . $row['article_file'] . '</td>';
                                        echo '<td>' . $row['division_article'] . '</td>';
                                        echo '<td>' . $row['reviewer_id'] . '</td>';
                                        echo '<td>' . $row['created_date'] . '</td>';

                                        echo '<td> ';
                                        echo ' <a  type="button" class="btn btn-xs btn-warning" href="rv_publishArticle.php">Publish</a>';
                                        echo ' <a  type="button" class="btn btn-xs btn-danger" href="rv_rejectArticle.php">Reject</a></td> ';

                                        echo '</tr> ';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
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