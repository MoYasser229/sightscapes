<?php
session_start();
?>
<html>
<body>

<?php
    $id=$_SESSION['ID'];
    $conn=new mysqli("localhost","root","","project");
    if($conn->connect_error)
    die ("cannot connect to the database");
    if($_SESSION['userRole'] === 'hiker'){
?>
<form  method ="POST" action = "">
<input type='submit' name='msg' value='Support Messages'><br>
<input type='submit' name='recgrp' value='Recommend a group'><br>
<input type='submit' name='issues' value='Issues'>
</form>
<?php
    }
    else if($_SESSION['userRole'] === 'admin'){
        displayChats();
    }
    else if($_SESSION['userRole'] === 'auditor'){
        $sql = "SELECT * FROM chat";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            $chatid = $row['chatID'];
            $chattype = $row['chatType'];
            $receiverid = $row['receiverID'];
            $senderid = $row['senderID'];
            $sql = "SELECT fname FROM Users WHERE userID = '$receiverid'";
            $resultRec = $conn->query($sql);
            if(mysqli_num_rows($resultRec) != 0)
                $receivername = implode($resultRec->fetch_assoc());
            else
                $receivername = "";
            $sql = "SELECT fname FROM Users WHERE userID = '$senderid'";
            $result2 = $conn->query($sql);
            if(mysqli_num_rows($result2) != 0)
                $sendername = implode($result2->fetch_assoc());
            else
                $sendername = "";
            echo "<p><a href='chat.php?chatID=$chatid'>$chattype<br>Reciever Name:$receivername Sender Name: $sendername</a></p>";
        }
    }
    else if($_SESSION['userRole'] === 'hr'){
        $conn = new mysqli("localhost","root","","project");
        $sql = "SELECT * FROM Warnings WHERE report = '0'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            $chatid = $row['chatID'];
            $admin = $row['userID'];
            $sql = "SELECT fname from users where userID = '$admin'";
            $result=$conn->query($sql) or die("Error: ".$conn->error);
            $adminName = '';
            if($row = $result->fetch_assoc()){
                $adminName = $row['fname'];
            }
            echo "<p><a href='chat.php?chatID=$chatid'>$adminName</a></p>";
        }
    }
    /////////////RECOMMEND PAGES
    if(isset($_POST["recgrp"])){
        $sql = "SELECT userID FROM Users WHERE userRole='Admin' ORDER BY RAND() LIMIT 1;";
        $result=$conn->query($sql) or die("Error: ".$conn->error);
        $row = $result->fetch_assoc();
        $admin=$row['userID'];

        $sql = "INSERT INTO chat(senderID,receiverID,chatType)
        VALUES ((SELECT userID from Users where userID='$id'),
        '$admin','Group Recommendation');";
        $result=$conn->query($sql) or die("Error: ".$conn->error);
        ///validate
        echo "<form method='post' action='chat.php?admin=$admin&chatType=Group Recommendation'>
        Location <input type='text' name='loc'><br>
        Description <input type='text' name='desc'> <br>
        Picture <input type='file' name='pic'><br>
        Link <input type='text' name='link'><br>
        <input type='submit' name='submit'>
        </form>";
    }
    ///support messages button makes all buttons disappears like creating a new page
    if(isset($_POST["msg"])){
        displayChats();
    }
    if(isset($_POST["issues"])){
        $sql = "SELECT userID FROM Users WHERE userRole='Admin' ORDER BY RAND() LIMIT 1;";
        $result=$conn->query($sql) or die("Error: ".$conn->error);
        $row = $result->fetch_assoc();
        $admin=$row['userID'];

        $sql = "INSERT INTO chat(senderID,receiverID,chatType)
        VALUES ('{$GLOBALS['id']}','$admin','Issues');";

        $result=$conn->query($sql) or die("Error: ".$conn->error);
        header("Location: chat.php?admin=$admin");
        // $chattype="issues";
        // $sql = "INSERT INTO chat(hikerID,adminID,auditorID,chatType) 
        //         VALUES( (SELECT hikerID FROM Hikers WHERE hikerID ='$usrn'),
        //         (SELECT adminID FROM Admins ORDER BY RAND() LIMIT 1),
        //         (SELECT auditorID FROM Auditors ORDER BY RAND() LIMIT 1), $chattype )";
        // $result=$conn->query($query) or die("Error: ".$conn->error);
        
        // $sql = "INSERT INTO chat(hikerID,adminID,auditorID,chatType) 
        // VALUES( (SELECT hikerID FROM Hikers WHERE hikerID ='$usrn'),
        // (SELECT adminID FROM Admins ORDER BY RAND() LIMIT 1),
        // (SELECT auditorID FROM Auditors ORDER BY RAND() LIMIT 1), $chattype )";
        // $result=$conn->query($query) or die("Error: ".$conn->error);
    }
    function displayChats(){
        $sql = "SELECT * FROM chat WHERE senderID='{$GLOBALS['id']}' OR receiverID = '{$GLOBALS['id']}'";
        $result=$GLOBALS['conn']->query($sql) or die("Error: ".$GLOBALS['conn']->error);
        while($row = $result->fetch_assoc()) {
            $receiverid=$row['receiverID'];
            $seen=array();
            $receivername=array();
            if($receiverid === $GLOBALS['id']){
                $receiverid = $row['senderID'];
            }
            $sql = "SELECT fname FROM Users WHERE userID='$receiverid'";
            $result2=$GLOBALS['conn']->query($sql) or die("Error: ".$GLOBALS['conn']->error);
            $receivername=implode($result2->fetch_assoc());
            $chatid=$row['chatID'];
            $chattypee=$row['chatType'];
            
            //     echo "<p><a href='chat.php?chatID=$chatid'><b>$chattypee</b><br><b>$receivername</b></a></p>";
            // echo "<br><br>";
            $sql = "SELECT seen FROM msg WHERE chatID='$chatid' AND seen = '0'";

            $result3=$GLOBALS['conn']->query($sql) or die("Error: ".$GLOBALS['conn']->error);
            // $seen=$result3->fetch_assoc();
            if(mysqli_num_rows($result3) != 0){
                echo "<p><a href='chat.php?chatID=$chatid&seen=1'><b>$chattypee</b><br><b>$receivername</b></a></p>";

            }
            else{
                echo "<p><a href='chat.php?chatID=$chatid'><em>$chattypee</em><br><em>$receivername</em></a></p>";
            }
            echo "<br><br>";
        }
    }
?>