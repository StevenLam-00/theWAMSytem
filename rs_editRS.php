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
            <!-- EDIT FORM  -->
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h2 class="sub-header">Edit Detail Profile</h2>
                <?php

                $sql_editRS = "SELECT * FROM users WHERE username='$_SESSION[username]'";
                $result = mysqli_query($conn, $sql_editRS);

                while ($row = mysqli_fetch_assoc($result)) {
                    $email = $row['email'];
                    $academicRank = $row['academicRank'];
                    $phonenumber = $row['phonenumber'];
                    $address = $row['address'];
                    $employment = $row['employment'];
                }

                ?>
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-5">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value=" <?php echo  $_SESSION['email'] ?> " required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="academicRank" class="col-sm-2 col-form-label">Academic Rank</label>
                        <div class="col-sm-5">
                            <select name="academicRank" class="form-control" required>
                                <option value="None">None</option>
                                <option value="Student">Student</option>
                                <option value="PhD">PhD</option>
                                <option value="Dr">Dr</option>
                                <option value="Assoc. Prof.">Assoc. Prof.</option>
                                <option value="Professor">Professor</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phonenumber" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="phonenumber" id="phonenumber" placeholder="Phone Number" value="<?php echo $_SESSION['phonenumber'] ?> " required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>

                        <div class="col-sm-5">
                            <textarea max="1000" class="form-control" placeholder="Address" name="address" value="<?php echo $_SESSION['address'] ?>" id="address"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="employment" class="col-sm-2 col-form-label">Employment</label>

                        <div class="col-sm-5">
                            <textarea max="1000" class="form-control" placeholder="Employment" name="employment" value="<?php echo  $_SESSION['employment'] ?>" id="employment"></textarea>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary mb-2" name="update-btn">Update Detail
                            Profile</button>
                    </div>

                    <?php

                    if (isset($_POST['update-btn'])) {

                        $email = $_POST['email'];
                        $academicRank = $_POST['academicRank'];
                        $phonenumber = $_POST['phonenumber'];
                        $address = $_POST['address'];
                        $employment = $_POST['employment'];

                        $sql_update_editRS = "UPDATE users SET email='$email', academicRank = '$academicRank', phonenumber='$phonenumber', address ='$address',employment ='$employment' WHERE username='" . $_SESSION['username'] . "';";

                        if (mysqli_query($conn, $sql_update_editRS)) {
                    ?>
                            <script type="text/javascript">
                                alert("Saved Successfully.");
                                window.location = "rs_profile.php";
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
    </div>
</body>

</html>