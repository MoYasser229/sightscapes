<?php
function customError($errorno, $errormsg){
    header('Location:../home/home.php');
}
function loginError($errorno, $errormsg){
    header('Location:../users/Login.php');
}
?>