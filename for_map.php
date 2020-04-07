<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/png" href="images/logo_title.png"/>
    <meta charset="utf-8">
    <title>Повече за картата</title>
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
include('includes/header.php');
?>

<div class="services" id="service">
    <br>
    <div style="text-align:center">
        <h3 class="tittle">Как се използва картата?</h3>
    </div>
    <div class="container text-center">
        <b>Картата е един инерактивен начин за откриване на забележителности. <br>Когато влезнем в профила си излизат три бутона - "Започни пътуването" , "В близост до мен" и "Посетени от мен"</b>
        <br>
        <br>
        <img src="images/buttons.jpg" alt="Бутони">
        <br>
        <br>
        <b>Когато кликнем бутона "Започни пътуването", в него се появяват три полета (Начална точка, Крайна точка и Радиус). <br>В полето "Начална точка" трябва да се въведе Град, място или забележителност от където искаме да тръгнем. <br>В полето "Крайна точка" се задава Град, място или забележителност до където искаме да стигнем.<br>
            В полето "Радиус" въвеждаме числа в километри, от които се показват кръгчета в радиус от зададения километър от пътя. <br>Когато сме въвели тези данни натискаме бутона "Покажи забележителности".<br> Картата обработва тези данни и ви показва забележителностите, въведени в базата с данни.<br></b>
        <br>
        <br>
        <img src="images/info.jpg" alt="Демонстрация на картата">
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
include 'includes/footer.php';
?>
