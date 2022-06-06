<?php
require_once 'controllers/authController.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Bootstrap4CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title> Sign In</title>
    <link rel="stylesheet" href="styleSignUp.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg py-3 sticky-top navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img class="logo" src="img/publications-logo.webp">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="RefSearching.html">References Searching</a>
                    </li>
                </ul>
                <button onclick="document.location='signIn.php'" class="btn btn-primary ms-lg-3">Sign
                    In</button>
                <button onclick="document.location='signUp.php'" class="btn btn-primary ms-lg-3">Sign
                    Up</button>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div">
                <form action="signUp.php" method="post" enctype="multipart/form-data">
                    <h3 class="text-center">Register</h3>

                    <?php if (count($errors) > 0) : //if there is any error -> show mess error 
                    ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error) : ?>
                        <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="username">Full Name:</label>
                        <input type="text" name="fullname" value="<?php echo $fullname; ?>"
                            class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" value="<?php echo $username; ?>"
                            class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="<?php echo $email; ?>"
                            class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="passwordConf">Confirm Password</label>
                        <input type="password" name="passwordConf" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="phonenumber">Phone Number</label>
                        <input type="text" name="phonenumber" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label>Select your role</label>
                        <select name="role" class="form-control" required>
                            <option value="Board Editor">Board Editor</option>
                            <option value="Reviewer">Reviewer</option>
                            <option value="Researcher">Researcher</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Academic Rank</label>
                        <select name="academicRank" class="form-control" required>
                            <option value="None">None</option>
                            <option value="Student">Student</option>
                            <option value="PhD">PhD</option>
                            <option value="Dr">Dr</option>
                            <option value="Assoc. Prof.">Assoc. Prof.</option>
                            <option value="Professor">Professor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Your Division</label>
                        <select name="division" class="form-control" required>
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
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea max="1000" class="form-control" placeholder="Address" name="address"
                            id="address"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="employment">Employment</label>
                        <textarea max="1000" class="form-control" placeholder="Employment" name="employment"
                            id="employment"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="signup-btn" class="btn btn-primary btn-block btn-lg">Sign
                            Up</button>
                    </div>
                    <p class="text-center">Already a member?<a href="signIn.php"> Sign In </a> </p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>