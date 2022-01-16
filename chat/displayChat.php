<?php
session_start();
$id = $_SESSION['ID'];
$conn = new mysqli("localhost" , "root" , "" , "project");
$sql = "SELECT * FROM chat WHERE senderID='{$id}' OR receiverID = '{$id}'";
        $result=$conn->query($sql) or die("Error: ".$conn->error);
        echo "<h1>CHATS</h1><hr>";
        while($row = $result->fetch_assoc()) {
            $receiverid=$row['receiverID'];
            $seen=array();
            $receivername=array();
            if($receiverid === $id){
                $receiverid = $row['senderID'];
            }
            $sql = "SELECT fname FROM Users WHERE userID='$receiverid'";
            $result2=$conn->query($sql) or die("Error: ".$conn->error);
            $receivername=implode($result2->fetch_assoc());
            $chatid=$row['chatID'];
            $chattypee=$row['chatType'];
            $admin = $row['receiverID'];
            
            $sql = "SELECT seen FROM msg WHERE chatID='$chatid' AND seen = '0'";

            $result3=$conn->query($sql) or die("Error: ".$conn->error);
            // $seen=$result3->fetch_assoc();
            if(mysqli_num_rows($result3) != 0){
                echo "<p><a href='chat.php?chatID=$chatid&admin=$admin&seen=1'><b>Admin $receivername</b><br><b>$chattypee</b></a></p>";

            }
            else{
                echo "<p><a href='chat.php?chatID=$chatid&admin=$admin'><em>Admin $receivername</em><br><em>$chattypee</em></a></p>";
            }
            echo "<hr><br><br>";
        }
?>