<?php


$current_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


if(strpos($current_url, ".php") == false ){ 
    if(strpos($current_url, ".eu/") !== false){
        $current_url = $current_url."index.php";
    }else{
        $current_url = $current_url."/index.php";
    }
}

if (strpos($current_url, '_en') !== false)  {
    $bg_link = str_replace("_en.php", ".php", $current_url);
    $en_link = $current_url;
} else {
    $bg_link = $current_url;
    $en_link = str_replace(".php", "_en.php", $current_url);
}

?>

<a href="<?php echo $bg_link; ?>"><img src="<?php echo Base_url(); ?>images/bg.png" style="width: 30px; height: 20px;"/></a>
<a href="<?php echo $en_link; ?>"><img src="<?php echo Base_url(); ?>images/en.png" style="width: 30px; height: 20px;"/></a>


