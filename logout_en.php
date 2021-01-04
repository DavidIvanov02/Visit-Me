<?php
include 'dbconnect.php';

if (!isset($_SESSION['user'])) {
    header("Location: index_en.php");
} else if(isset($_SESSION['user'])!="") {
    header("Location: home_en.php");
}

unset($_SESSION['user']);
session_unset();
session_destroy();
header("Location: index_en.php");
exit;
?>