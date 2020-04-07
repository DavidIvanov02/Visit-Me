<div class="wrapper row0">
    <div id="topbar" class="hoc clear">
        <div class="fl_left">
            <ul class="nospace">
                <li><a href="<?php echo Base_url(); ?>index_en.php"><img src="<?php echo Base_url(); ?>images/logo.png" alt="Site logo"></a></li>
            </ul>
        </div>
        <div class="fl_right">
            <ul class="nospace">
                <li><a href="<?php echo Base_url(); ?>map/indexmap_en.php"><i class="fa fa-lg fa-home"></i>Start the trip</a></li>
                <li><a href="<?php echo Base_url(); ?>map/../for_map_en.php">More about the map</a></li>
                
                <?php if(isset($userRow['userName'])): // proverqva ako si lognat ?>
                    <li>Hello, <?=$userRow['userName']; // pokazva imeto ?></li>
                    <li><a href="<?php echo Base_url(); ?>logout_en.php">Logout</a></li>
                <?php endif; ?>
                
                <?php if(!isset($userRow['userName'])): ?>
                    <li><a href="<?php echo Base_url(); ?>login_en.php">Login</a></li>
                    <li><a href="<?php echo Base_url(); ?>register_en.php">Sign up</a></li>
                <?php endif; ?>
                
                <?php include "languagebuttons.php"; ?>
            </ul>
        </div>
    </div>
</div>