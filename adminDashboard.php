<?php require_once 'controllers/authController.php';
if (!isset($_SESSION['id'])) {
    header('location: signIn.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Bootstrap4CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="styleSignUp.css">
    <title>Homepage</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div login">

                <?php if (isset($_SESSION['message'])) : ?>
                <div class="alert" <?php $_SESSION['alert-class']; ?>>
                    <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                        unset($_SESSION['alert-class']);
                        ?>
                </div>
                <?php endif; ?>
                <h3>Welcome, <?php echo $_SESSION['username']; ?> </h3>
                <a href="signIn.php" class="logout">Log Out</a>
            </div>
        </div>
    </div>
</body>

</html>