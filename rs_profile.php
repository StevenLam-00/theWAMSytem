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
                    <li><a href="<?php echo BASE_URL . 'rs_dashboard.php' ?>">
                            Articles</a>
                    </li>
                    <li class="active"><a href="<?php echo BASE_URL . 'rs_profile.php' ?>">Profile</a>
                    </li>
                    <li><a href="<?php echo BASE_URL . 'rs_submitArticle.php' ?>">Submit Article</a></li>
                    <li><a href="<?php echo BASE_URL . 'rs_approvedArticle.php' ?>">My Approved Article</a></li>
                    <li><a href="<?php echo BASE_URL . 'rs_rejectedArticle.php' ?>">My Rejected
                            Article</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">My General Profile</h1>
                <?php
                $q = mysqli_query($conn, "SELECT * FROM users where username='$_SESSION[login_user]' ;"); ?>
                <?php
                $row = mysqli_fetch_assoc($q);
                $_SESSION['login_user'];

                ?>

                <?php
                echo "<table class='table table-bordered'>";

                echo "<tr>";
                echo "<td>";
                echo "<b>Your User ID: </b>";
                echo "</td>";

                echo "<td>";
                echo $row['id'];
                echo "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>";
                echo "<b>Full Name: </b>";
                echo "</td>";

                echo "<td>";
                echo $row['fullname'];
                echo "</td>";
                echo "</tr>";


                echo "<tr>";
                echo "<td>";
                echo "<b>Username: </b>";
                echo "</td>";

                echo "<td>";
                echo $row['username'];
                echo "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>";
                echo "<b>Role: </b>";
                echo "</td>";

                echo "<td>";
                echo $row['role'];
                echo "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>";
                echo "<b>Division: </b>";
                echo "</td>";

                echo "<td>";
                echo $row['division'];
                echo "</td>";
                echo "</tr>";

                echo "</table>";
                ?>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">My Detail Profile</h1>
                <form method="POST" action="">
                    <?php
                    $sql_detailInfo = mysqli_query($conn, "SELECT * FROM users where username='$_SESSION[username]';"); ?>
                    <?php
                    $row = mysqli_fetch_assoc($sql_detailInfo);
                    $_SESSION['username'];
                    ?>

                    <?php
                    echo "<table class='table table-bordered'>";

                    echo "<tr>";
                    echo "<td>";
                    echo "<b>Email: </b>";
                    echo "</td>";

                    echo "<td>";
                    echo $row['email'];
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "<b>Academic Rank: </b>";
                    echo "</td>";

                    echo "<td>";
                    echo $row['academicRank'];
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "<b>Phone Number: </b>";
                    echo "</td>";

                    echo "<td>";
                    echo $row['phonenumber'];
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "<b>Address </b>";
                    echo "</td>";

                    echo "<td>";
                    echo $row['address'];
                    echo "</td>";
                    echo "</tr>";


                    echo "<tr>";
                    echo "<td>";
                    echo "<b>Employment: </b>";
                    echo "</td>";

                    echo "<td>";
                    echo $row['employment'];
                    echo "</td>";
                    echo "</tr>";

                    echo "</table>";
                    ?>
                    <button type="submit" class="btn btn-primary mb-2" name="editRS-btn">Edit Detail Profile</button>
                    <?php

                    if (isset($_POST['editRS-btn'])) {
                    ?>
                    <script type="text/javascript">
                    window.location = "rs_editRS.php"
                    </script>
                    <?php
                    }
                    ?>
                </form>
            </div>
        </div>
        <script src=" <?php echo BASE_URL . 'assets/js/jquery-1.10.2.js' ?>"></script>
        <script src="<?php echo BASE_URL . 'assets/js/bootstrap.js' ?>"></script>
        <script src="<?php echo BASE_URL . 'assets/js/jquery.flexslider.js' ?>"></script>
        <script src="<?php echo BASE_URL . 'assets/js/scrollReveal.js' ?>"></script>
        <script src="<?php echo BASE_URL . 'assets/js/jquery.easing.min.js' ?>"></script>
        <script src="<?php echo BASE_URL . 'assets/js/custom.js' ?>"></script>
    </div>
</body>

</html>