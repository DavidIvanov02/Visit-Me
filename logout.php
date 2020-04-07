<?php
include 'dbconnect.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
} else if(isset($_SESSION['user'])!="") {
    header("Location: home.php");
}

unset($_SESSION['user']);
session_unset();
session_destroy();
header("Location: index.php");
exit;
?>