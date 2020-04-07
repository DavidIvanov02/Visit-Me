<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/png" href="images/logo_title.png"/>
    <meta charset="utf-8">
    <title>More about the map</title>
    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <style type="text/css">
        .container .demo{text-align:center;}
        .container .demo div{padding:8px 0;}
        .container .demo div:nth-child(odd){color:#FFFFFF; background:#CCCCCC;}
        .container .demo div:nth-child(even){color:#FFFFFF; background:#979797;}
        @media screen and (max-width:900px){.container .demo div{margin-bottom:0;}}
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body id="top">
<?php
include 'dbconnect.php';
include('includes/header_en.php');
?>

<div class="services" id="service">
    <br>
    <div style="text-align:center">
        <h3 class="tittle">How to use the map?</h3>
    </div>
    <div class="container text-center">
        <b>The map is an inactive way of discovering landmarks. <br>When we log in, there are three buttons - "Start the trip" , "Close to me" and "Visited by me"</b>
        <br>
        <br>
        <img src="images/buttons_english.jpg" alt="Buttons">
        <br>
        <br>
        <b>When we click the "Start Trip" button, three fields appear (Start Point, Endpoint, and Radius). <br>In the "Start Point" field, enter City, Place, or Landmark from where we want to go. <br>The "Endpoint" field is set to City, Place, or Landmark where we want to reach.<br>
            In the "Radius" field, we enter numbers in kilometers from which circles are displayed within a radius of the specified kilometer of the road. <br>When we have entered this data, we click the "Show Landmarks"."button".<br> The map processes these data and shows you the landmarks that are entered in the database.<br></b>
        <br>
        <br>
        <img src="images/infoo.jpg" alt="Info">
    </div>
    <div class="clearfix"></div>
</div>
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>
<?php
include 'includes/footer_en.php';
?>
