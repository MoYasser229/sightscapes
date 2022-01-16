<?php
    session_start();
    include_once '../errorHandler/errorHandlers.php';
    set_error_handler('loginError',E_ALL);
    $userID = $_SESSION['ID'];
    $conn = new mysqli("localhost" , "root" , "" , "project");
    $sql = "SELECT * FROM WARNINGS WHERE userID = $userID";
    $result = $conn->query($sql);
   // if($row = $result->fetch_assoc()){
        echo "<h1> PENALTIES </h1>";
        while($row = $result->fetch_assoc()){
            $chatID = $row['chatID'];
            $senderName = '';
            //[TODO] MIGHT ADD A LINK TO SEE THE CHAT (NOT YET DECIDED)
            $sql = "SELECT fname from users WHERE userID = (SELECT senderID FROM chat WHERE chatID = $chatID)";
            $result = $conn->query($sql);
            if($FnameRow = $result->fetch_assoc()){
                $senderName = $FnameRow['fname'];
            }
            echo "<h4>PENALTY ADDED TO YOU FROM CHAT ID#$chatID</h4>";
            echo "<h5>THE HIKER IN THE CHAT WAS $senderName</h5>";
            echo "<br>";
        }
    //}
    //else{
        //echo "<h6>NO REPORTS/PENALTIES GIVEN TO YOU</h6>";
    //}
   
?>