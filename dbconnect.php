<?php

if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}

// this will avoid mysql_connect() deprecation error.
error_reporting(E_ALL);
ini_set("display_error",1);
session_start();

define('DBHOST', 'localhost');
define('DBUSER', 'noit1_visitme');
define('DBPASS', 'noit1_visitme');
define('DBNAME', 'noit1_visitme_db');

$conn = @mysqli_connect(DBHOST,DBUSER,DBPASS);
$dbcon = mysqli_select_db($conn, DBNAME);\
    mysqli_query($conn, "SET NAMES'utf8'");

if ( !$conn ) {
    die("Connection failed : " . mysqli_error());
}

if ( !$dbcon ) {
    die("Database Connection failed : " . mysqli_error());
}

include('includes/functions.php');

if( isset($_SESSION['user']) ) {
    $res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
    $userRow=mysqli_fetch_array($res);
}

?>