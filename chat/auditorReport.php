<?php
    $chatID = $_POST['chatID'];
    $conn = new mysqli("localhost","root","","project");
    $sql = "SELECT receiverID from chat where chatID = '$chatID'";
                $result=$conn->query($sql) or die("Error: ".$conn->error);
                $admin = '';
                if($row = $result->fetch_assoc()){
                    $admin = $row['receiverID'];
                }

    $sql = "INSERT INTO Warnings(userID,chatID,report) VALUES ('$admin','$chatID','0')";
    $conn->query($sql) or die("Error: ".$conn->error);
?>