<?php
    if(isset($_SESSION['ID']))
        setcookie('UserCartID', $_SESSION['ID'] ,time() + 86400, '/');
 
function insert($hiker_id, $groups){
        $_COOKIE['UserCartID'] = $hiker_id;
        setcookie('GroupsCart', $groups ,time() + 86400, '/');
}