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
    <title>Researcher | Dashboard</title>
    <link href="<?php echo BASE_URL . 'assets/css/bootstrap.css' ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/dashboard.css' ?>">
    <link href="<?php echo BASE_URL . 'assets/css/font-awesome.min.css' ?>" rel=" stylesheet" />
</head>

<body>

    <nav class=" navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Researcher | Dashboard</a>
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
                    <li><a href="<?php echo BASE_URL . 'rs_dashboard.php' ?>">Articles</a>
                    </li>
                    <li><a href=" <?php echo BASE_URL . 'rs_profile.php' ?>">Profile</a></li>
                    <li><a href="<?php echo BASE_URL . 'rs_submitArticle.php' ?>">Submit Article</a></li>
                    <li><a href="<?php echo BASE_URL . 'rs_approvedArticle.php' ?>">My Approved Article</a></li>
                    <li class="active"><a name="rejectedArticle"
                            href="<?php echo BASE_URL . 'rs_rejectedArticle.php' ?>">My Rejected
                            Article</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <form method="POST" action="">
                    <h2 class="sub-header">Rejected Articles Table</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Authors</th>
                                    <th>File Name</th>
                                    <th>Date Submit</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = 'SELECT * FROM rejectedArticle';
                                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

                                $q = mysqli_query($conn, "SELECT * FROM users where username='$_SESSION[login_user]' ;");
                                $row_username = mysqli_fetch_assoc($q);
                                $_SESSION['login_user'];

                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($row_username['username'] == $row['sbm_by_user']) {
                                        echo '<tr>';
                                        echo '<td>' . $row['rejectedArticle_id'] . '</td>';
                                        echo '<td>' . $row['title'] . '</td>';
                                        echo '<td>' . $row['authors'] . '</td>';
                                        echo '<td>' . $row['article_file'] . '</td>';
                                        echo '<td>' . $row['created_date'] . '</td>';
                                        echo '<td>' . $row['message_be'] . '</td>';

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