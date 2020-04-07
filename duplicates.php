<?php
include "map/map_php/init.php";

$zabelejitelnosti = $db->getAllSights();

$all_duplicates = array();


foreach($zabelejitelnosti as $key => $z){
    $zabelejitelnosti[$key]['duplicates'] = array();
    if(!in_array($z['s_id'], $all_duplicates)){
        foreach($zabelejitelnosti as $s){
            if($z['s_lat'] == $s['s_lat'] && $z['s_lng'] == $s['s_lng'] && $z['s_id'] != $s['s_id']){
                $zabelejitelnosti[$key]['duplicates'][] = $s;
                $all_duplicates[] = $s['s_id'];
            }
        }
    }
}
?>
<html>
    <head>
        <title>Duplicates</title>
        <meta charset="utf-8">
    </head>
    <body>
        <ul>
        <?php
        foreach($zabelejitelnosti as $z){
            if(count($z['duplicates']) > 0){ ?>
                <li>
                    <?php echo $z['s_id'] ?> - <?php echo $z['s_name'] ?>:
                    <ul>
                        <?php foreach($z['duplicates'] as $d): ?>
                        <li><?php echo $d['s_id'] ?> - <?php echo $d['s_name'] ?></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <hr />
            <?php }
        }
        ?>
        </ul>
    </body>
</html>