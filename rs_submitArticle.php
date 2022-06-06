<?php
session_start();
include("path.php");
require 'controllers/infor_submitArticle.php';

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
                    <li><a href=" <?php echo BASE_URL . 'rs_profile.php' ?>">Profile</a>
                    </li>
                    <li class="active"><a href="<?php echo BASE_URL . 'rs_submitArticle.php' ?>">Submit Article</a></li>
                    <li><a href="<?php echo BASE_URL . 'rs_approvedArticle.php' ?>">My Approved Article</a></li>
                    <li><a href="<?php echo BASE_URL . 'rs_rejectedArticle.php' ?>">My Rejected Article</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">SUBMIT ARTICLE</h1>
                <form method="POST" action="" enctype="multipart/form-data">
                    <h4 class="page-header">Author(s) information</h4>
                    <div class="form-group row">
                        <label for="authors_name" class="col-sm-2 col-form-label">Author(s) name:</label>
                        <div class="col-sm-5">
                            <textarea max="1000" class="form-control" placeholder="Full Name of Author(s)"
                                name="authors" id="authors_name" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email_contact" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-5">
                            <input type="email" class="form-control" name="email_contact" id="email_con"
                                placeholder="Email for Contact" required>
                        </div>
                    </div>
                    <br><br>
                    <h4 class="page-header">Article information</h4>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tittle:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="title" id="tid"
                                placeholder="Tittle of Article" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="abstracts" class="col-sm-2 col-form-label">Abstract:</label>
                        <div class="col-sm-5">
                            <textarea max="1000" class="form-control" placeholder="Abstract of Article" name="abstracts"
                                id="abst"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keywords" class="col-sm-2 col-form-label">Keywords:</label>
                        <div class="col-sm-5">
                            <textarea max="1000" class="form-control" placeholder="Keyword of Article" name="keywords"
                                id="kword"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ref_article" class="col-sm-2 col-form-label">References of Article:</label>
                        <div class="col-sm-5">
                            <textarea max="1000" class="form-control" placeholder="References of Article"
                                name="ref_article"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Division:</label>
                        <div class="col-sm-5">
                            <select name="division_article" class="form-control" required>

                                <option value="None">None</option>
                                <option value="Architecture">Architecture</option>
                                <option value="Business & Economy">Business & Economy</option>
                                <option value="Education">Education</option>
                                <option value="Health & Medical Sciences">Health & Medical Sciences</option>
                                <option value="History">History</option>
                                <option value="Humanities & Art">Humanities & Art</option>
                                <option value="Law">Law</option>
                                <option value="Philosophy">Philosophy</option>
                                <option value="Social Sciences">Social Sciences</option>
                                <option value="Sports">Sports</option>
                                <option value="Technology & Engineering">Technology & Engineering</option>
                                <option value="Tourism">Tourism</option>

                            </select>
                        </div>
                    </div>
                    <h4 class="page-header">Upload Article File:</h4>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">File in "MS Word" format only</label>
                        <div class="col-sm-5">
                            <input type="File" class="form-control" name="article_file" required>
                        </div>
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-primary mb-2" name="submit_article-btn">Submit</button>
                </form>
            </div>
        </div>
        <script src="<?php echo BASE_URL . 'assets/js/jquery-1.10.2.js' ?>"></script>
        <script src="<?php echo BASE_URL . 'assets/js/bootstrap.js' ?>"></script>
        <script src="<?php echo BASE_URL . 'assets/js/jquery.flexslider.js' ?>"></script>
        <script src="<?php echo BASE_URL . 'assets/js/scrollReveal.js' ?>"></script>
        <script src="<?php echo BASE_URL . 'assets/js/jquery.easing.min.js' ?>"></script>
        <script src="<?php echo BASE_URL . 'assets/js/custom.js' ?>"></script>
        <?php

        ?>

</body>

</html>