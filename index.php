<?php
include 'dbconnect.php';
include 'map/map_php/init.php';
$sights = $db->getTopVisited();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Посети ме!</title>
    <link rel="shortcut icon" type="image/png" href="images/logo_title.png"/>
    <meta charset="utf-8">
      <meta name="description" content="Посети ме!">
  <meta name="keywords" content="Открий своя вълшебен маршрут!">
    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
<?php include('includes/header.php'); ?>

<div class="wrapper bgded overlay" style="background-image:url('images/demo/backgrounds/ir.bmp');">
    <div id="pageintro" class="hoc clear">
        <article>
            <p class="heading">Открий своя вълшебен маршрут!</p>
            <h2 class="heading"><span class="block">Посети</span>ме!</h2>
            <footer>
                <ul class="nospace inline pushright">
                    <?php
                    if(isset($userRow) && $userRow){
                        ?>
                        <li><a class="btn" href="map/indexmap.php">Започни пътуването</a></li>
                        <li><a class="btn" href="geolocation.php">В близост до мен</a></li>
                        <li><a href="visited.php" class="btn">Посетени от мен</a></li>
                    <?php } else { ?>
                        <li><a class="btn" href="login.php">Вход</a></li>
                        <li><a class="btn" href="register.php">Регистрация</a></li>
                    <?php }	 ?>
                </ul>
            </footer>
        </article>
    </div>
</div>
<section class="about-us" id="about">
    <?php if(!isset($userRow['userName'])){ ?>
        <div class="wrapper row3">
            <div class="hoc container clear">
                <h2 class="heading">Какво представлява сайтът?</h2>
                <p>Проектът представлява един интерактивен пътеводител за всеки любител на пътешествията. Посредством GOOGLE MAPS API, в комбинация с БД от забележителности и техните геокоординати, системата избира най-добрия маршрут до дадена дестинация, като предлага близки места за разглеждане в определен радиус. </p>
            </div>
        </div>
    <?php } ?>
    <section class="about-us">
        <div class="wrapper row3">
            <main class="hoc container clear">
                <div style="text-align:center;margin-bottom:15px;">
                    <h3>Класация на най-посещаваните места</h3>
                    Тук може да видите най-посещаваните места в Европа и България според нашия сайт!<br/>
                </div>
                <ul class="nospace group cta">

                    <?php foreach($sights as $key => $sight): ?>
                        <!-- single thing starts here -->
                        <li class="one_quarter <?php if($key == 0) echo 'first'; ?>">
                            <img src="<?php echo Base_url() ?>images/map_images/<?php echo $sight['s_filename'] ?>" alt="<?php echo $sight['s_name'] ?>">
                            <hr><h6 class="heading font-x1"><a href="#" onclick="return false;"><?php echo $sight['s_name'] ?></a></h6>
                            <p>Посетена: <b><?php echo $sight['visited'] ?></b>  пъти</p>
                        </li>
                        <!-- single thing ends here -->
                    <?php endforeach; ?>

                </ul>
                <div class="clear"></div>
            </main>
        </div>
    </section>
    <?php include 'includes/footer.php'; ?>
    <a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
    <!-- JAVASCRIPTS -->
    <script src="layout/scripts/jquery.min.js"></script>
    <script src="layout/scripts/jquery.backtotop.js"></script>
    <script src="layout/scripts/jquery.mobilemenu.js"></script>
</section>
</body>
</html>
