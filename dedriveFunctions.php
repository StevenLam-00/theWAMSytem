<?php
define('DBINFO', 'mysql:host=localhost;dbname=preThe_db');
define('DBUSER', 'root');
define('DBPASS', 'root');

function performQuery($query)
{
    $con = new PDO(DBINFO, DBUSER, DBPASS);
    $stmt = $con->prepare($query);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function fetchAll($query)
{
    $con = new PDO(DBINFO, DBUSER, DBPASS);
    $stmt = $con->query($query);
    return $stmt->fetchAll();
}