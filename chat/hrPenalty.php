<?php
    $conn = new mysqli("localhost" , "root" , "" , "project");
    $chatID = $_POST["chatID"];
    $sql = "UPDATE Warnings SET report = '1' WHERE chatID = '$chatID'";
    $conn->query($sql);
?>