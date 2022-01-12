<?php
    if(isset($_SESSION['ID']))
        setcookie('UserCartID', $_SESSION['ID'] ,time() + 86400, '/');
 
function insert($hiker_id, $groups){
    // $sql = "INSERT into cart(hikerID,GID) values ('$hiker_id', '$group_id')";
    // if($GLOBALS['conn']->query($sql)){

        $_COOKIE['UserCartID'] = $hiker_id;
        // $newArr = [];
        // if(isset($_COOKIE['GroupsCart'])){
        //     $_COOKIE['GroupsCart'] = json_decode($_COOKIE['GroupsCart']);
        //     $_COOKIE['GroupsCart'] .= " $groups";
        //     $groups = $_COOKIE['GroupsCart'];
        // //     $i = 0;
        // //     while($row = $_COOKIE['GroupsCart']){
        // //         $newArr[$i++] = $_COOKIE['GroupsCart'][0];
        // //     }
        // //     $newArr[$i] = $groups;
        // }
        setcookie('GroupsCart', $groups ,time() + 86400, '/');
        
        // }
    // else
    //     echo $GLOBALS['conn']->error;
}