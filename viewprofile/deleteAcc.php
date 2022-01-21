<?php 
session_start();
?>
<html>
<body>

<?php
$hn='localhost';
$db='project';
$un='root';
$pw='';
$id=$_SESSION["ID"];
$conn=new mysqli("localhost","$un","$pw","$db") 
or die ("fatal error cannot connect to DB");

        $sql = "DELETE from users WHERE userID = '$id'";
        $results = $conn-> query($sql);
        if($results)
        {
        session_destroy();
       header("Location:../users/Login.php");
        }


?>