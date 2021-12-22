<?php
function insert($hiker_id, $group_id){
    $sql = "insert into cart(hikerid,GID) values ('".$hiker_id." ', '".$group_id."')";
    if($GLOBALS['conn']->query($sql)){
        $_COOKIE['id'] = $hiker_id;
        $_COOKIE['group_id'] = $group_id;
    }
    else
        echo $GLOBALS['conn']->error;
}