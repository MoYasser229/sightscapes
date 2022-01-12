<?php
    $conn = new mysqli("localhost" , "root" , "" , "project");
    $chatID=$_POST["chatID"];
    $sql = "SELECT auditorComment FROM msg WHERE chatID = '$chatID'";
    
?>