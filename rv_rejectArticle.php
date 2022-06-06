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
                    <li><a href="<?php echo BASE_URL . 'rv_dashboard.php' ?>">
                            Incoming Article</a></li>
                    <li><a href="<?php echo BASE_URL . 'rv_reviewerProfile.php' ?>">Profile</a></li>
                    <li><a href="<?php echo BASE_URL . 'rv_publishArticle.php' ?>">Publish Article</a>
                    </li>
                    <li class="active"><a href="<?php echo BASE_URL . 'rv_rejectArticle.php' ?>">Reject Article</a></li>
                </ul>
            </div>

            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <form method="POST" action="">
                    <h2 class="sub-header">Rejected Message</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>SBM by</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = 'SELECT * FROM approvedArticle';
                                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

                                while ($row = mysqli_fetch_assoc($result)) {

                                    $approvedArticle_id = $row['approvedArticle_id'];
                                    $title = $row['title'];
                                    $_SESSION['approvedArticle_id'] = $approvedArticle_id;
                                    $_SESSION['title'] = $title;

                                    echo '<tr>';
                                    echo '<td>' . $row['approvedArticle_id'] . '</td>';
                                    echo '<td>' . $row['title'] . '</td>';
                                    echo '<td>' . $row['sbm_by_user'] . '</td>';

                                    echo '<td> ';
                                    echo ' <a  type="button" class="btn btn-xs btn-warning" href="rv_rejectArticle_message.php">GIVE COMMENT</a></td> ';


                                    echo '</tr> ';
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                    <br><br><br>
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
                                $query = 'SELECT * FROM approvedArticle';
                                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr>';
                                    echo '<td>' . $row['approvedArticle_id'] . '</td>';
                                    echo '<td>' . $row['title'] . '</td>';
                                    echo '<td>' . $row['authors'] . '</td>';
                                    echo '<td>' . $row['article_file'] . '</td>';
                                    echo '<td>' . $row['created_date'] . '</td>';
                                    echo '<td>' . $row['message_rv'] . '</td>';

                                    echo '</tr> ';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </form>
                <?php
                include('dedriveFunctions.php');
                $query = "INSERT INTO approvedArticle (sbm_by_user, authors, email_contact, title, abstracts, keywords, ref_article, division_article, created_date, article_file) SELECT sbm_by_user, authors, email_contact, title, abstracts, keywords, ref_article, division_article, created_date, article_file FROM approvedArticle WHERE approvedArticle_id = '" . $_GET['approvedArticle_id'] . "'";
                if (mysqli_query($conn, $query)) {
                    $remove = "DELETE FROM approvedArticle WHERE approvedArticle_id = '" . $_GET['approvedArticle_id'] . "'";
                    if (mysqli_query($conn, $remove)) {
                        exit();
                    } else {
                        echo "Error: " . $remove . "<br>" . mysqli_error($conn);
                    }
                    exit();
                } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($conn);
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

</body>

</html>