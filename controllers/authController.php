<?php
session_start();
require 'config/db.php';
$errors = array();
$username = "";
$fullname = "";
$email = "";
$password = "";
$role = "";
$academicRank = "";
$division = "";
$phonenumber = "";
$address = "";
$employment = "";
// =========================================
// |
// |         CLICK SIGN UP BUTTON                           
// |
// =========================================
if (isset($_POST['signup-btn'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];
    $role = $_POST['role'];
    $academicRank = $_POST['academicRank'];
    $division = $_POST['division'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];
    $employment = $_POST['employment'];

    // ======================
    // |       validation                          
    // ======================
    if (empty($fullname)) {
        $errors['fullname'] = "Full Name required";
    }
    if (empty($role)) {
        $errors['role'] = "Role required";
    }
    if (empty($division)) {
        $errors['division'] = "Division required";
    }
    if (empty($username)) {
        $errors['username'] = "Username required";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email must be a valid email address";
    }
    if (empty($email)) {
        $errors['email'] = "Email required";
    }
    if (empty($password)) {
        $errors['password'] = "Password required";
    }

    if ($password !== $passwordConf) {
        $errors['password'] = "The confirm password does not match";
    }

    // when see 1 record => stop searching => LIMIT 1
    $emailQuery = "SELECT*FROM users WHERE email=? LIMIT 1";
    $usernameQuery = "SELECT * FROM users WHERE username=? LIMIT 1";

    $stmt = $conn->prepare($emailQuery);
    $stmt->bind_param('s', $email); //bind_param(string, var)
    $stmt->execute();
    // res to check user return from the db who has an email like provided
    $result = $stmt->get_result(); // execute stmt to search => get result => return to $result
    $userCount = $result->num_rows; //create object num_rows
    $stmt->close();

    $stmt_username = $conn->prepare($usernameQuery);
    $stmt_username->bind_param('s', $username); //bind_param(string, var)
    $stmt_username->execute();
    // res to check user return from the db who has an username like provided
    $result_username = $stmt_username->get_result();
    $userCount_username = $result_username->num_rows; //create object num_rows
    $stmt_username->close();

    if ($userCount > 0) {
        $errors['email'] = "Email already exists";
    } else if ($userCount_username > 0) {
        $errors['username'] = "Username already exists";
    }

    if (count($errors) === 0) {
        // password_hash($the password user entered, PASSWORD_DEFAULT encrypts password -> then return to $password )
        $password = password_hash($password, PASSWORD_DEFAULT);


        $sql = "INSERT INTO users (fullname, username, email, password, role, division, academicRank, phonenumber, employment, address) VALUES(?,?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssssssss', $fullname, $username, $email, $password, $role, $division, $academicRank, $phonenumber, $employment, $address);


        if ($stmt->execute()) {
            //login user
            $user_id = $conn->insert_id;
            $_SESSION['id'] = $user_id;
            $_SESSION['fullname'] = $fullname;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            $_SESSION['academicRank'] = $academicRank;
            $_SESSION['division'] = $division;
            $_SESSION['phonenumber'] = $phonenumber;
            $_SESSION['address'] = $address;
            $_SESSION['employment'] = $employment;

            header('location: signIn.php');
            exit();
        } else {
            $errors['db_error'] = "Database error: failed to register";
        }
    }
}

// =========================================
// |
// |         CLICK SIGN IN BUTTON                           
// |
// =========================================
if (isset($_POST['signin-btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    // validation
    if (empty($username)) {
        $errors['username'] = "Username required";
    }
    if (empty($password)) {
        $errors['password'] = "Password required";
    }

    if (count($errors) === 0) {
        $sql = "SELECT * FROM users WHERE username=? OR email=? AND role=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $username, $username, $role);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // login user
            $_SESSION['id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['login_user'] = $_POST['username'];
            $_SESSION['academicRank'] = $user['academicRank'];
            $_SESSION['division'] = $user['division'];
            $_SESSION['phonenumber'] = $user['phonenumber'];
            $_SESSION['address'] = $user['address'];
            $_SESSION['employment'] = $user['employment'];


            if ($user['role'] === 'Admin') {
                $_SESSION['admin'] = $user['role'];
                //flash message
                header('location: ad_dashboard.php');
                exit();
            } else if ($user['role'] === 'Reviewer') {
                $_SESSION['reviewer'] = $user['role'];
                //flash message
                header('location: rv_dashboard.php');
                exit();
            } else if ($user['role'] === 'Board Editor') {
                $_SESSION['boardEditor'] = $user['role'];
                //flash message
                header('location: be_dashboard.php');
                exit();
            } else if ($user['role'] === 'Researcher') {
                $_SESSION['researcher'] = $user['role'];
                //flash message
                header('location: rs_dashboard.php');
                exit();
            }
        } else {
            $errors['login_fail'] = "Wrong credential";
        }
    }
}

// =========================================
// |
// | LOG OUT
// |
// =========================================
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['id']);
    unset($_SESSION['fullname']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['role']);
    unset($_SESSION['academicRank']);
    unset($_SESSION['division']);
    unset($_SESSION['phonenumber']);
    unset($_SESSION['address']);
    unset($_SESSION['employment']);
    header('location: signIn.php');
    exit();
}

// =========================================
// |
// | RECOVER PASSWORD BUTTON
// |
// =========================================
if (isset($_POST['forgot-password'])) {
    $email = $_POST['email'];
}