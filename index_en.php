<?php
include 'dbconnect.php';
include 'map/map_php/init.php';
$sights = $db->getTopVisited();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Visit me!</title>
    <link rel="shortcut icon" type="image/png" href="images/logo_title.png"/>
    <meta charset="utf-8">
      <meta name="description" content="Visit me!">
  <meta name="keywords" content="Find your magic path!">
    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
<?php include('includes/header_en.php'); ?>

<div class="wrapper bgded overlay" style="background-image:url('images/demo/backgrounds/ir.bmp');">
    <div id="pageintro" class="hoc clear">
        <article>
            <p class="heading">Find your magic path!</p>
            <h2 class="heading"><span class="block">Visit</span>me!</h2>
            <footer>
                <ul class="nospace inline pushright">
                    <?php
                    if(isset($userRow) && $userRow){
                        ?>
                        <li><a class="btn" href="map/indexmap_en.php">Start the trip</a></li>
                        <li><a class="btn" href="geolocation_en.php">Close to me</a></li>
                        <li><a href="visited_en.php" class="btn">Visited by me</a></li>
                    <?php } else { ?>
                        <li><a class="btn" href="login_en.php">Login</a></li>
                        <li><a class="btn" href="register_en.php">Sign up</a></li>
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
                <h2 class="heading">What is Visit me?</h2>
                <p>The project is an interactive guide for every lover of travel. Using the GOOGLE MAPS API, combined with landmarks and their geo-coordinates, the system selects the best route to a destination by offering close-to-view views within a certain radius. </p>
            </div>
        </div>
    <?php } ?>
    <section class="about-us">
        <div class="wrapper row3">
            <main class="hoc container clear">
                <div style="text-align:center;margin-bottom:15px;">
                    <h3>Ranking of the most visited places</h3>
                    Here you can see the most visited places in Europe and Bulgaria according to our site!<br/>
                </div>
                <ul class="nospace group cta">

                    <?php foreach($sights as $key => $sight): ?>
                        <!-- single thing starts here -->
                        <li class="one_quarter <?php if($key == 0) echo 'first'; ?>">
                            <img src="<?php echo Base_url() ?>images/map_images/<?php echo $sight['s_filename'] ?>" alt="<?php echo $sight['s_name'] ?>">
                            <hr><h6 class="heading font-x1"><a href="#" onclick="return false;"><?php echo $sight['s_name'] ?></a></h6>
                            <p>Visited: <b><?php echo $sight['visited'] ?></b> times</p>
                        </li>
                        <!-- single thing ends here -->
                    <?php endforeach; ?>

                </ul>
                <div class="clear"></div>
            </main>
        </div>
    </section>
    <?php include 'includes/footer_en.php'; ?>
    <a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
    <!-- JAVASCRIPTS -->
    <script src="layout/scripts/jquery.min.js"></script>
    <script src="layout/scripts/jquery.backtotop.js"></script>
    <script src="layout/scripts/jquery.mobilemenu.js"></script>
</section>
</body>
</html>
