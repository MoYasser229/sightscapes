<?php session_start();
include_once '../errorHandler/errorHandlers.php';
//set_error_handler('customError',E_ALL);
?>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <link href='../styles/chatStyles.css' type='text/css' rel="stylesheet">
        <meta charset="utf-8">
        <title>Sightscape</title>

    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
<body style="background-color: #0b1d26">

<?php
    $id=$_SESSION['ID'];
    function checkLogin(){
			if(!isset($_SESSION['ID']) && !isset($_SESSION['userRole'])){
			?>
			<nav class="navbar navbar-expand-md fixed-top navbar-dark background">
						<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
							<ul class="navbar-nav mr-auto">
							<li class="nav-item">
									<a class="nav-link active" aria-current="page" href="../home.php"><h6>HOME</h6></a>
									</li>
									<li class="nav-item">
									<a class="nav-link" href="../viewGroups/grouphikers.php"><h6>GROUP</h6></a>
									</li>
							</ul>
						</div>
						<div class="mx-auto order-0">
						<a class="navbar-brand" href="../home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
								<span class="navbar-toggler-icon"></span>
							</button>
						</div>
						<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
							<ul class="navbar-nav ml-auto">
							<li class="nav-item">
									<a class="nav-link" href="../users/Login.php"><h6>LOGIN</h6></a>
									</li>
									<li class="nav-item">
									<a class="nav-link" href="../users/Signup.php"><h6>SIGN UP</h6></a>
									</li>
							</ul>
						</div>
						</nav>
								<?php
								}
								else if ($_SESSION['userRole'] === "admin"){
									?>
											<nav class="navbar navbar-expand-md fixed-top navbar-dark background">
										<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
											<ul class="navbar-nav mr-auto">
												<li class="nav-item">
												<a class="nav-link active" aria-current="page" href="../home.php"><h6>HOME</h6></a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="../admincontrol/admin.php"><h6>DATA MANAGEMENT</h6></a>
											</li>
											</ul>
										</div>
										<div class="mx-auto order-0">
										<a class="navbar-brand" href="../home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
											<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
												<span class="navbar-toggler-icon"></span>
											</button>
										</div>
										<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
											<ul class="navbar-nav ml-auto">
											<li class="nav-item">
											<a class="nav-link" href="../chat/newChat.php"><h6>CHAT</h6></a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="../users/signOut.php"><h6>SIGN OUT</h6></a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="../viewprofile/projecthome.php"><h6>PROFILE</h6></a>
										</li>
											</ul>
										</div>
									</nav>
									<?php
								}
								else if($_SESSION['userRole'] === 'hiker'){
									?>
									<nav class="navbar navbar-expand-md fixed-top navbar-dark background">
										<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
											<ul class="navbar-nav mr-auto">
												<li class="nav-item">
												<a class="nav-link active" aria-current="page" href="../home.php"><h6>HOME</h6></a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="../viewgroups/grouphikers.php"><h6>GROUPS</h6></a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="../cart/cart.php"><h6>CART</h6></a>
											</li>
											</ul>
										</div>
										<div class="mx-auto order-0">
										<a class="navbar-brand" href="../home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
											<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
												<span class="navbar-toggler-icon"></span>
											</button>
										</div>
										<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
											<ul class="navbar-nav ml-auto">
											<li class="nav-item">
											<a class="nav-link" href="../chat/newChat.php"><h6>CHAT</h6></a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="../users/signOut.php"><h6>SIGN OUT</h6></a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="../viewprofile/projecthome.php"><h6>PROFILE</h6></a>
										</li>
											</ul>
										</div>
									</nav>
									<?php
								}
								else if($_SESSION['userRole'] === "auditor"){
									?>
									<nav class="navbar navbar-expand-md fixed-top navbar-dark background">
										<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
											<ul class="navbar-nav mr-auto">
												<li class="nav-item">
												<a class="nav-link active" aria-current="page" href="../home.php"><h6>HOME</h6></a>
											</li>
											<li class="nav-item">
											<a class="nav-link" href="../chat/chatMenu.php"><h6>CHAT</h6></a>
										</li>
                                        <li class="nav-item">
											<a class="nav-link" href="../survey/survey.php"><h6>SURVEY</h6></a>
										</li>
											</ul>
										</div>
										<div class="mx-auto order-0">
										<a class="navbar-brand" href="../home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
											<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
												<span class="navbar-toggler-icon"></span>
											</button>
										</div>
										<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
											<ul class="navbar-nav ml-auto">
										<li class="nav-item">
											<a class="nav-link" href="../users/signOut.php"><h6>SIGN OUT</h6></a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="../viewprofile/projecthome.php"><h6>PROFILE</h6></a>
										</li>
											</ul>
										</div>
									</nav>
									<?php
								}
								else if($_SESSION['userRole'] == 'hr'){
									?>
									<nav class="navbar navbar-expand-md fixed-top navbar-dark background">
										<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
											<ul class="navbar-nav mr-auto">
												<li class="nav-item">
												<a class="nav-link active" aria-current="page" href="../home.php"><h6>HOME</h6></a>
											</li>
											<li class="nav-item">
											<a class="nav-link" href=""><h6>CHAT REPORTS</h6></a>
										</li>
											</ul>
										</div>
										<div class="mx-auto order-0">
										<a class="navbar-brand" href="../home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
											<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
												<span class="navbar-toggler-icon"></span>
											</button>
										</div>
										<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
											<ul class="navbar-nav ml-auto">
										<li class="nav-item">
											<a class="nav-link" href="../users/signOut.php"><h6>SIGN OUT</h6></a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="../viewprofile/projecthome.php"><h6>PROFILE</h6></a>
										</li>
											</ul>
										</div>
									</nav>
									<?php
								}
	}
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
                    
                    /* The popup form - hidden by default */
                    .form-popup {
                        display: none;
                        position: fixed;
                        bottom: 15%;
                        right: 15%;
                        top: 15%;
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
                    .form-container input[type=text]:focus, .form-container input[type=password]:focus {
                        background-color: #ddd;
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
                            <p>LOCATION</p> <input type='text' name='loc'><br>
                            <p>DESCRIPTION</p> <input type='text' name='desc'> <br>
                            <p>PICTURE</p> <input type='file' name='pic'><br>
                            <p>LINK</p> <input type='text' name='link'><br>
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
        echo "<form method='post' action='chat.php?admin=$admin&chatType=Group Recommendation' enctype= 'multipart/form-data'>
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
            
            $admin = $row['receiverID'];

            $sql = "SELECT seen FROM msg WHERE chatID='$chatid' AND seen = '0'";

            $result3=$GLOBALS['conn']->query($sql) or die("Error: ".$GLOBALS['conn']->error);
            // $seen=$result3->fetch_assoc();
            if(mysqli_num_rows($result3) != 0){
                echo "<p><a href='chat.php?chatID=$chatid&seen=1&admin=$admin'><b>$chattypee</b><br><b>$receivername</b></a></p>";
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

<footer class="container-fluid bg-grey py-5">
            <div class="container ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="logo-part">
                                <img src="../bckgrnd/logo.png" class="w-75 logo-footer" >
                            </div>
                            </div>
                            <div class="col-md-6 px-4">
                            <h6> About Company</h6>
                            <p>A website that connects all hikers in one place. We are here to give all hikers opportunity to view various hiking groups to different locations.</p>
                            <p>Our goal is to provide a service that organize hiking trips to all hikers on earth.</p>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <h6> Newsletter</h6>
                            <div class="social">
                                <a href="https://facebook.com"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="https://instagram.com"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="https://twitter.com"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="https://youtube.com"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                            </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </footer>
</body>
</html>