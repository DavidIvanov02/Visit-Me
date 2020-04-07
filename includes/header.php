<div class="wrapper row0">
    <div id="topbar" class="hoc clear">
        <div class="fl_left">
            <ul class="nospace">
                <li><a href="<?php echo Base_url(); ?>index.php"><img src="<?php echo Base_url(); ?>images/logo.png" alt="Site logo"></a></li>
            </ul>
        </div>
        <div class="fl_right">
            <ul class="nospace">
                <li><a href="<?php echo Base_url(); ?>map/indexmap.php"><i class="fa fa-lg fa-home"></i>Започни пътуването</a></li>
                <li><a href="<?php echo Base_url(); ?>map/../for_map.php">Повече за картата</a></li>

                <?php if(isset($userRow['userName'])): // proverqva ako si lognat ?>
                    <li>Здравей, <?=$userRow['userName']; // pokazva imeto ?></li>
                    <li><a href="<?php echo Base_url(); ?>logout.php">Изход</a></li>
                <?php endif; ?>

                <?php if(!isset($userRow['userName'])): ?>
                    <li><a href="<?php echo Base_url(); ?>login.php">Вход</a></li>
                    <li><a href="<?php echo Base_url(); ?>register.php">Регистрация</a></li>
                <?php endif; ?>

                <?php include "languagebuttons.php"; ?>

            </ul>
        </div>
    </div>
</div>