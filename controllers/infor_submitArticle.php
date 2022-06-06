<?php
session_start();
require 'config/db.php';
$authors = "";
$email_contact = "";
$title = "";
$abstracts = "";
$keywords = "";
$ref_article = "";
$division_article = "";


// =========================================
// |
// |         CLICK SUBMIT ARTICLE BUTTON                           
// |
// =========================================

// Uploads files
if (isset($_POST['submit_article-btn'])) {
    $authors = $_POST['authors'];
    $email_contact = $_POST['email_contact'];
    $title = $_POST['title'];
    $abstracts = $_POST['abstracts'];
    $keywords = $_POST['keywords'];
    $ref_article = $_POST['ref_article'];
    $division_article = $_POST['division_article'];

    $fileName = $_FILES['article_file']['name'];
    $fileTmpName = $_FILES['article_file']['tmp_name'];
    $path = "files/" . $fileName;
    $query = "INSERT INTO Article (article_file) VALUES ('$fileName')";

    $run = mysqli_query($conn, $query);
    move_uploaded_file($fileTmpName, $path);
    $_SESSION['article_file'] = $fileName;

    $article_id = $conn->insert_id;
    $_SESSION['article_id'] = $article_id;


    $sql = "UPDATE Article SET sbm_by_user = '$_SESSION[username]' ,authors = '$authors', email_contact = '$email_contact', title = '$title', abstracts = '$abstracts', keywords = '$keywords', ref_article ='$ref_article', division_article ='$division_article' WHERE article_file ='" . $_SESSION['article_file'] . "';";


    if (mysqli_query($conn, $sql)) {

        $_SESSION['authors'] = $authors;
        $_SESSION['email_contact'] = $email_contact;
        $_SESSION['title'] = $title;
        $_SESSION['abstracts'] = $abstracts;
        $_SESSION['keywords'] = $keywords;
        $_SESSION['ref_article'] = $ref_article;
        $_SESSION['division_article'] = $division_article;

        header("Location: rs_dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}