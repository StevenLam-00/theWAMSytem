<?php
if (!empty($_GET['article_file'])) {
    $fileName  = basename($_GET['article_file']);
    $filePath  = "files/" . $fileName;

    if (!empty($fileName) && file_exists($filePath)) {
        //define header
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");

        //read file 
        readfile($filePath);
        exit;
    } else {
        echo "<script>alert('The file does not exist.');</script>";
    }
}