<?php session_start();
include_once '../errorHandler/errorHandlers.php';
// set_error_handler('customError',E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <link href='../styles/chatstyle.css' type='text/css' rel="stylesheet">
        <meta charset="utf-8">
        <title>Sightscape Chat</title>

    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
function load(checkAuditor){
        chatID = "<?php echo (isset($_GET['chatID']))?$_GET['chatID']:''; ?>"
        loc = "<?php echo (isset($_POST['loc']))?$_POST['loc']:''; ?>";
        desc = "<?php echo (isset($_POST['desc']))?$_POST['desc']:''; ?>";
        pic = "<?php 
        $dir = "images/";
        $pic = '';
        if(!empty($_FILES['pic']['name'])){
            $pic = $_FILES['pic']['name'];
            move_uploaded_file($_FILES['pic']['tmp_name'], $dir.$pic);
        }
        echo $pic; 
        
        ?>";
        link = "<?php echo (isset($_POST['link']))?$_POST['link']:''; ?>";
        chatType = "<?php echo (isset($_GET['chatType']))?'Group Recommendation':'Issues'; ?>";
        admin = "<?php echo (isset($_GET['admin']))?$_GET['admin']:''; ?>";
        checkForm="<?php echo (isset($_POST['loc']))?true:false; ?>";
        $.ajax({
                type: 'POST',
                url: 'messageDB.php',
                data: { 
                    'chatID':chatID,
                    'checkForm':checkForm,
                    'chatType':chatType,
                    'admin':admin,
                    'loc':loc,
                    'desc':desc,
                    'pic':pic,
                    'link':link,
                    'auditor': checkAuditor
                },
                success: function (result){
                    $('#div1').append(result);
                }
            });
    }
</script>
<?php
if(isset($_GET['seen']) && isset($_GET['chatID'])){
    $seen = $_GET['seen'];
    $chatID = $_GET['chatID'];
    $conn = new mysqli("localhost","root","","project");
    if($seen === '1'){
        $sql = "UPDATE msg SET seen = 1 WHERE chatID = '$chatID'";
        $conn->query($sql) or die($conn->error);
    }
}
if($_SESSION['userRole'] === 'auditor'){
    $chatID = $_GET['chatID'];
        $auditorComment = '';
        reportAdmin($chatID, $auditorComment);
    ?>
    <script>
        $(document).ready(function(){
            load(1)
        })
    </script>

    <body style='background-color: #0b1d26'>
    <?php
        function checkLogin(){
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
                    <a class="nav-link" href="../viewprofile/profile.php"><h6>PROFILE</h6></a>
                </li>
                    </ul>
                </div>
            </nav>
            <?php
        }
        checkLogin();
    ?>
        <div id="div1" style="color: white; margin-top: 75px;">
        <h1 style="text-align: center; font-size: 50px;">Admin Chat</h1>
        <hr style="background-color: goldenrod; width: 90%">
        </div>
        
        <?php
        
        $conn = new mysqli("localhost" , "root" , "" , "project");
            if(isset($_POST['commentMsg'])){
                echo "<script> alert('{$_POST['commentMsg']}') </script>";
                echo "<form action = 'chat.php?chatID=$chatID' method = 'POST'><input type = 'text' name = 'comment'><input type = 'submit' name = 'submitComment' value = {$_POST['commentMsg']}></form>";
            }
            if(isset($_POST['submitComment'])){
                $msgID = $_POST['submitComment'];
                if(isset($_POST['comment']))
                    $auditorComment = $_POST['comment'];
                $sql = "UPDATE msg SET auditorComment = '$auditorComment' WHERE msgID = '$msgID'";
                $result=$conn->query($sql) or die("Error: ".$conn->error);
                // $sql = "SELECT recieverID from chat where chatID = '$chatID'";
                // $result=$conn->query($sql) or die("Error: ".$conn->error);
                // $receiverID = '';
                // if($row = $result->fetch_assoc()){
                //     $receiverID = $row['receiverID'];
                // }
            }
            
        ?>
    </body>
    </html>
    <?php

}
else if($_SESSION['userRole'] === 'hr'){
    function checkLogin(){
        ?>
        <nav class="navbar navbar-expand-md fixed-top navbar-dark background">
            <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../home.php"><h6>HOME</h6></a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="chatMenu.php"><h6>CHAT REPORTS</h6></a>
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
                <a class="nav-link" href="../viewprofile/profile.php"><h6>PROFILE</h6></a>
            </li>
                </ul>
            </div>
        </nav>
        <?php
    }
    checkLogin();
    ?>
    <body style = 'background-color: #0b1d26'>
        <script>
            $(document).ready(function(){
            load(2)
        })
        </script>
        <style>
            .topText{
                margin-top: 100px;
                color: white;
                text-align: center;
                font-family: serif;
            }
            .topText hr{
                background-color: goldenrod;
                width: 90%;
            }
        </style>
        <div class='topText'>
            <h1>Penalty Section</h1>
            <hr>
        </div>
        <div id="div1"></div>
        
        <?php
        $chatID = $_GET['chatID'];
        $conn = new mysqli("localhost","root","","project");
        $sql = "SELECT userID FROM Warnings WHERE chatID = '$chatID'";
        $result = $conn->query($sql);
        $adminID = '';
        if($row = $result->fetch_assoc()){
            $adminID = $row['userID'];
        }
        $sql = "SELECT auditorComment FROM msg WHERE chatID = '$chatID'";
        $result = $conn->query($sql);
        $comment = '';
        if($row = $result->fetch_assoc()){
            $comment = $row['auditorComment'];
        }
        ?>
        <div id = 'divReport'>
             <button onclick = 'onPenalty()' class = 'penaltyStyle fixed-top' name="penalty">ADD PENALTY</button>
        </div>
       
        <script>
            function onPenalty(){
                chatID = "<?php echo $chatID; ?>"
                $.ajax({
                    method: "POST",
                    url: "hrPenalty.php",
                    data: {
                        'chatID':chatID
                    },
                    success: function(result){
                         $('#divReport').html('<h1 class = "penaltyStyleDone fixed-top">PENALTY GIVEN SUCCESSFULLY</h1>')
                    }
                })
            }
        </script>
    </body>
    </html>
    <?php
}
else{
        ?>
            <script>
            $(document).ready(function(){
                var input = document.getElementById("message");
                input.addEventListener("keyup", function(event) {
                    if (event.keyCode === 13) {
                        document.getElementById("submit").click();
                    }
                });
                chatID = "<?php echo (isset($_GET['chatID']))?$_GET['chatID']:''; ?>"
                chatType = "<?php echo (isset($_GET['chatType']))?'Group Recommendation':'Issues'; ?>"
                admin = "<?php echo (isset($_GET['admin']))?$_GET['admin']:''; ?>"
                load(0);
                $('button').click(function(){
                    msg = $(message).val();
                    //load(0)
                        $.ajax({
                                type: 'POST',
                                url: 'messageDB.php',
                                data: { 
                                    'msgText': msg, 
                                    'chatID':chatID,
                                    'chatType':chatType,
                                    'admin':admin
                                },
                                success: function(msg2){
                                    $('#div1').append('<p>'+msg2+'</p>');
                                    $('#message').val('');
                                }
                        });
                });
            });
            
            </script>
        </head>
        <body style= "background-color: #0b1d26">
            <?php
                function checkLogin(){
                    if ($_SESSION['userRole'] === "admin"){
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
                                <a class="nav-link" href="../chat/chatMenu.php"><h6>CHAT</h6></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../users/signOut.php"><h6>SIGN OUT</h6></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../viewprofile/profile.php"><h6>PROFILE</h6></a>
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
                                <a class="nav-link" href="../chat/chatMenu.php"><h6>CHAT</h6></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../users/signOut.php"><h6>SIGN OUT</h6></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../viewprofile/profile.php"><h6>PROFILE</h6></a>
                            </li>
                                </ul>
                            </div>
                        </nav>
                        <?php
                    }
                }
                checkLogin();
            ?>
            <div class="cont">
                <div class = 'Header'>
                    <?php if($_SESSION['userRole'] === 'hiker') { ?>
                    <h1>Discuss Your Issue <br>With The Admin</h1>
                    <?php } else{ ?>
                    <h1>Help The Hiker in Their<br>Issue or Request</h1>
                    <?php } ?>
                    <hr>
                </div>
                <div class = 'Chat'>
                    <div class = "msgContainer" id="div1"></div>
                    <br>
                    <div class="messageBar ml-100">
                        <input type="text" id="message">
                        <button id="submit"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
    }
function reportAdmin($chatID, $auditorComment){
    $conn = new mysqli("localhost","root","","project");
    $checkAlreadyWarnedQuery = "SELECT warningID FROM warnings WHERE chatID = '$chatID'";
    $checkAlreadyWarnedResult = $conn->query($checkAlreadyWarnedQuery);
    if($row = $checkAlreadyWarnedResult->fetch_assoc()){
        echo "<h1 class = 'fixed-top reportText'>ALREADY REPORTED</h1>";
    }
    else{
        echo "<div id = 'divReport'><button class = 'fixed-top reportButton' onclick='onReport()' type = 'submit' name='report'><h1>REPORT ADMIN</h1></button></div>";
        ?>
        <script>
            function onReport(){
                auditorComment = "<?php echo $auditorComment; ?>"
                chatID = "<?php echo $chatID; ?>"
                $.ajax({
                    method: "POST",
                    url: "auditorReport.php",
                    data: {
                        'auditorComment': auditorComment,
                        'chatID':chatID
                    },
                    success: function(result){
                         $('#divReport').html('<h1 class = "reportButtonDone fixed-top">ADMIN REPORTED SUCCESSFULLY</h1>')
                    }
                })
            }
        </script>
        <?php
    }
}

?>