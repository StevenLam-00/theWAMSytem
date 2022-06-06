<?php
session_start();
$error = array();

require "mail.php";



if (!$con = mysqli_connect("localhost", "root", "root", "changeHashed")) {

    die("could not connect");
}

$mode = "enter_email";
if (isset($_GET['mode'])) {
    $mode = $_GET['mode'];
}

//something is posted
if (count($_POST) > 0) {

    switch ($mode) {
        case 'enter_email':
            // code...
            $email = $_POST['email'];
            //validate email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error[] = "Please enter a valid email";
            } elseif (!valid_email($email)) {
                $error[] = "That email was not found";
            } else {

                $_SESSION['forgot']['email'] = $email;
                send_email($email);
                header("Location: forgotPassword.php?mode=enter_code");
                die;
            }
            break;

        case 'enter_code':
            // code...
            $code = $_POST['code'];
            $result = is_code_correct($code);

            if ($result == "the code is correct") {

                $_SESSION['forgot']['code'] = $code;
                header("Location: forgotPassword.php?mode=enter_password");
                die;
            } else {
                $error[] = $result;
            }
            break;

        case 'enter_password':
            // code...
            $password = $_POST['password'];
            $password2 = $_POST['password2'];

            if ($password !== $password2) {
                $error[] = "Passwords do not match";
            } elseif (!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])) {
                header("Location: forgotPassword.php");
                die;
            } else {

                save_password($password);
                if (isset($_SESSION['forgot'])) {
                    unset($_SESSION['forgot']);
                }

                header("Location: signIn.php");
                die;
            }
            break;

        default:
            // code...
            break;
    }
}

function send_email($email)
{

    global $con;

    $expire = time() + (60 * 1);
    $code = rand(10000, 99999);
    $email = addslashes($email);

    $query = "insert into resetPassword (email,code,expire) value ('$email','$code','$expire')";
    mysqli_query($con, $query);

    //send email here
    send_mail($email, 'Password reset', "Your code is " . $code);
}

function save_password($password)
{

    global $con;

    $password = password_hash($password, PASSWORD_DEFAULT);
    $email = addslashes($_SESSION['forgot']['email']);

    $query = "update users set password = '$password' where email = '$email' limit 1";
    mysqli_query($con, $query);
}

function valid_email($email)
{
    global $con;

    $email = addslashes($email);

    $query = "select * from users where email = '$email' limit 1";
    $result = mysqli_query($con, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            return true;
        }
    }

    return false;
}

function is_code_correct($code)
{
    global $con;

    $code = addslashes($code);
    $expire = time();
    $email = addslashes($_SESSION['forgot']['email']);

    $query = "select * from resetPassword where code = '$code' && email = '$email' order by id desc limit 1";
    $result = mysqli_query($con, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['expire'] > $expire) {

                return "the code is correct";
            } else {
                return "the code is expired";
            }
        } else {
            return "the code is incorrect";
        }
    }

    return "the code is incorrect";
}

?>

<?php require_once 'controllers/authController.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Bootstrap4CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="styleSignUp.css">
</head>

<body>
    <?php
    switch ($mode) {
        case 'enter_email':
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div signin">
                <form action="forgotPassword.php?mode=enter_email" method="post">
                    <h3 class="text-center">Forgot Password</h3>
                    <p>Enter your email address, then check the receive mail to recover password </p>
                    <span style="font-size: 12px;color:red;">
                        <?php
                                foreach ($error as $err) {
                                    echo $err . "<br>";
                                } ?>
                    </span>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-lg">
                    </div>

                    <div class="form-group">
                        <button type="submit" name="forgot-password" class="btn btn-primary btn-block btn-lg">Recover
                            Password</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <?php
            break;
        case 'enter_code':
        ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div signin">
                <form action="forgotPassword.php?mode=enter_code" method="post">
                    <h3 class="text-center">Forgot Password</h3>
                    <p>Enter your the code sent to your email</p>
                    <span style="font-size: 12px;color:red;">
                        <?php
                                foreach ($error as $err) {
                                    echo $err . "<br>";
                                } ?>
                    </span>
                    <div class="form-group">
                        <input type="text" name="code" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Next" style="float: right;">
                    </div>
                    <a href="forgotPassword.php">
                        <input type="button" value="Start Over">
                    </a>
                </form>
            </div>
        </div>
    </div>
    <?php
            break;
        case 'enter_password':
        ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div signin">
                <form action="forgotPassword.php?mode=enter_password" method="post">
                    <h3 class="text-center">Forgot Password</h3>
                    <p>Enter new password</p>
                    <span style="font-size: 12px;color:red;">
                        <?php
                                foreach ($error as $err) {
                                    echo $err . "<br>";
                                } ?>
                    </span>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-lg"
                            placeholder="Enter new password"> <br>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password2" class="form-control form-control-lg"
                            placeholder="Retype new password"> <br>
                    </div>
                    <br style="clear: both;">
                    <input type="submit" value="Next" style="float: right;">
                    <a href="forgotPassword.php">
                        <input type="button" value="Start Over">
                    </a>
                    <br><br>
                    <p class="text-center">Sign In a again<a href="signIn.php"> Click </a> </p>
                </form>
            </div>
        </div>
    </div>
    <?php
            break;
        default:
            break;
    } ?>
</body>

</html>