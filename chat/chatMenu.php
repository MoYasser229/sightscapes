<?php session_start();
include_once '../errorHandler/errorHandlers.php';
set_error_handler('customError',E_ALL);
?>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <link href='../styles/chatStyles.css' type='text/css' rel="stylesheet">
        <meta charset="utf-8">
        <title>Sightscapes</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
<body style="background-color: #0b1d26">

<?php
    $id=$_SESSION['ID'];
   include_once "../users/checkLogin.php";
	checkLogin();
    $conn=new mysqli("localhost","root","","project");
    if($conn->connect_error)
    die ("cannot connect to the database");
    //close/open form HERE
    if($_SESSION['userRole'] === 'hiker'){
        ?>
        <div class="con">
            <div class="child-con">
                <h1>Welcome to Sightscapes Help</h1>
            </div>
            <div class="child-con">
                <form  method ="POST" action = "chatMenu.php#chats">
                    <hr>
                    <a href='chatMenu.php#previousChat' onClick='ajaxLoader()'>LOAD PREVIOUS MESSAGES</a><br>
                    <p> Have all your previous issues and group suggestions all in one place.</p>
                    <hr>
                   
                    
                    <input type='submit' name='issues' value='CREATE AN ISSUE CHAT'>
                    <hr>
                </form>
                <style type="text/css">
                    .open-button {
                        background-color: transparent;
                        color: white;
                        font-size: 35px;
                        font-family: serif;
                        padding: 10px;
                        border: none;
                        margin-left: 25%;
                    }
                    
                    .form-popup {
                        display: none;
                        position: fixed;
                        bottom: 5%;
                        right: 15%;
                        top: 10%;
                        left: 15%;
                        border: 3px solid #f1f1f1;
                        background-color: #173f53;
                        z-index: 9;
                        border-radius: 25px;
                        padding-top: 50px;
                    }
                    .form-popup h5{
                        color: white;
                        text-align: center;
                        font-size: 30px;
                    }
                    
                    /* Add styles to the form container */
                    .form-container {
                        background-color: #173f53;
                        /* max-width: 300px; */
                        padding: 10px;
                        height: 25%;
                    }
                    
                    /* Full-width input fields */
                    .form-container input[type=text] {
                        width: 100%;
                        height: 50px;
                        margin: 5px 0 22px 0;
                        border: none;
                        background-color: #0b1d26;
                    }
                    .form-container input[type=file]{
                        text-align: center;
                        font-size: 20px;
                        color: white;
                        margin-left: 40%;
                        margin-right: 40%;
                        margin-bottom: 20px;
                    }
                    
                    /* When the inputs get focus, do something */
                    .form-container input[type=text]:focus{
                        outline: none;
                    }
                    
                    /* Set a style for the submit/login button */
                    .form-container .btn {
                        background-color: #04AA6D;
                        color: white;
                        padding: 16px 20px;
                        border: none;
                        cursor: pointer;
                        width: 10%;
                        margin-bottom:10px;
                        opacity: 0.8;
                    }
                    
                    /* Add a red background color to the cancel button */
                    .form-container .cancel {
                        background-color: red;
                    }
                    
                    /* Add some hover effects to buttons */
                    .form-container .btn:hover, .open-button:hover {
                        opacity: 1;
                    }
                    .form-container p{
                        color: white;
                        font-size: 20px;
                    }
                    .topText{
                        color: white;
                        text-align: center;

                    }
                </style>
                 <button class = 'open-button' onclick = 'openForm()'>RECOMMEND A GROUP</button><br>
                 <p class = 'topText'>Not Interested in any of our offerings? You can submit a form to add a group of your choice. Send the desired location from the link above and one of our adminstrators will reply soon.</p>
                    <hr>
                 <div class="form-popup" id="myForm">
                     <h5>REQUEST A GROUP</h5>
                    <form method='post' action='<?php 
                        $sql = "SELECT userID FROM Users WHERE userRole='Admin' ORDER BY RAND() LIMIT 1;";
                        $result=$conn->query($sql) or die("Error: ".$conn->error);
                        $row = $result->fetch_assoc();
                        $admin=$row['userID'];
                        echo "chat.php?admin=$admin&chatType=Group Recommendation"
                    ?>' enctype= 'multipart/form-data' class = 'form-container'>
                            <p>LOCATION</p> <input type='text' name='loc' required><br>
                            <p>DESCRIPTION</p> <input type='text' name='desc' required> <br>
                            <p>PICTURE</p> <input type='file' name='pic'><br>
                            <p>LINK</p> <input type='text' name='link' required><br>
                        <button type="submit" class="btn" name = 'submitRequest' >SUBMIT</button>
                        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                    </form>
                    </div>

                    <script>
                    function openForm() {
                    document.getElementById("myForm").style.display = "block";
                    }

                    function closeForm() {
                    document.getElementById("myForm").style.display = "none";
                    }
                    </script>
            </div>
        </div>
        <div id = 'previousChat' class = 'previousChat'>
        </div>
        <?php
    }
    else if($_SESSION['userRole'] === 'admin'){
        ?>
        <div class="adminMidChat">
            <h1>Your Chats</h1>
            <hr>
            <?php displayChats(); ?>
        </div>
        <?php
    }
    else if($_SESSION['userRole'] === 'auditor'){
        $sql = "SELECT * FROM chat";
        $result = $conn->query($sql);
        echo "<div id='chats'>";
        echo "<h1>CHATS</h1><hr>";
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
            
            echo "<p><a href='chat.php?chatID=$chatid'>$chattype<br>ADMIN:$receivername<br>  HIKER: $sendername</a></p><hr>";
            
        }
        echo "</div>";
    }
    else if($_SESSION['userRole'] === 'hr'){
        $conn = new mysqli("localhost","root","","project");
        $sql = "SELECT * FROM Warnings WHERE report = '0'";
        $result = $conn->query($sql);
        ?>
            <style>
                .chatReported a{
                    margin-left: 100px;
                    color: white;
                    font-family: serif;
                    font-size: 30px;
                }
                .chatReported a:hover{
                    text-decoration: none;
                    color: goldenrod;
                }
                .chatReported hr{
                    background-color: goldenrod;
                    width: 90%;
                }
                .textReports{
                    color: white;
                    font-family: serif;
                    text-align: center;
                    font-size: 20px;
                    width: 30%;
                    margin-left: 35%;
                }
            </style>
            <h1 style = 'margin-top: 200px; text-align: center; color: white; font-size: 50px'>ADMIN REPORTS</h1>
            <p class = 'textReports'>
                In here, you can see all reported chats between admins and hikers. These reports are
                from an auditor who can view all chats in the website and report some of them to you.
            </p>
            <hr style = 'background-color: goldenrod; width: 90%'>
        <?php
        while($row = $result->fetch_assoc()){
            $chatid = $row['chatID'];
            $admin = $row['userID'];
            $sql = "SELECT fname from users where userID = '$admin'";
            $result=$conn->query($sql) or die("Error: ".$conn->error);
            $adminName = '';
            if($row = $result->fetch_assoc()){
                $adminName = $row['fname'];
            }
            
            echo "<div class = 'chatReported'><a href='chat.php?chatID=$chatid'>$adminName</a><hr></div>";
        }
    }
    if(isset($_POST["issues"])){
        $sql = "SELECT userID FROM Users WHERE userRole='Admin' ORDER BY RAND() LIMIT 1;";
        $result=$conn->query($sql) or die("Error: ".$conn->error);
        $row = $result->fetch_assoc();
        $admin=$row['userID'];

        $sql = "INSERT INTO chat(senderID,receiverID,chatType)
        VALUES ('{$GLOBALS['id']}','$admin','Issues');";

        $result=$conn->query($sql) or die("Error: ".$conn->error);
        echo "<script>window.location.replace('chat.php?admin=$admin')</script>";
    }
    function displayChats(){
        $sql = "SELECT * FROM chat WHERE senderID='{$GLOBALS['id']}' OR receiverID = '{$GLOBALS['id']}'";
        $result=$GLOBALS['conn']->query($sql) or die("Error: ".$GLOBALS['conn']->error);
        while($row = $result->fetch_assoc()) {
            $receiverid=$row['receiverID'];
            $receivername=array();
            if($receiverid === $GLOBALS['id']){
                $receiverid = $row['senderID'];
            }
            $sql = "SELECT fname FROM Users WHERE userID='$receiverid'";
            $result2=$GLOBALS['conn']->query($sql) or die("Error: ".$GLOBALS['conn']->error);
            $receivername=implode($result2->fetch_assoc());
            $chatid=$row['chatID'];
            $chattypee=$row['chatType'];
            
            $admin = $row['receiverID'];

            $sql = "SELECT seen FROM msg WHERE chatID='$chatid' AND seen = '0'";

            $result3=$GLOBALS['conn']->query($sql) or die("Error: ".$GLOBALS['conn']->error);
            // $seen=$result3->fetch_assoc();
            if(mysqli_num_rows($result3) != 0){
                echo "<p><a href='chat.php?chatID=$chatid&seen=1&admin=$admin'><b><u>$chattypee</u></b><br><b><u>$receivername</u></b></a></p>";
            }
            else{
                echo "<p><a href='chat.php?chatID=$chatid&admin=$admin'><em>$chattypee</em><br><em>$receivername</em></a></p>";
            }
            echo "<hr>";
        }
    }
?>
<script>
    $(document).ready(function(){
        ajaxLoader()
    })
    function ajaxLoader() {
        $.ajax({
            method: 'POST',
            url: 'displayChat.php',
            success: (chats) => {
                $('.previousChat').html(chats)
            }
            })
    }
</script>
</body>
</html>