<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js "></script>
<script>
function load(checkAuditor){
        chatID = "<?php echo (isset($_GET['chatID']))?$_GET['chatID']:''; ?>"
        loc = "<?php echo (isset($_POST['loc']))?$_POST['loc']:''; ?>";
        desc = "<?php echo (isset($_POST['desc']))?$_POST['desc']:''; ?>";
        pic = "<?php echo (isset($_POST['pic']))?$_POST['pic']:''; ?>";
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
                    $('#div1').append('<h1>'+result+'</h1><br>');
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
    ?>
    <script>
        $(document).ready(function(){
            load(1)
        })
    </script>

    <body>
        <div id="div1"></div>
        
        <?php
        $chatID = $_GET['chatID'];
        $auditorComment = '';
        
        $conn = new mysqli("localhost" , "root" , "" , "project");
            if(isset($_POST['commentMsg'])){
                echo "<form action = 'chat.php?chatID=$chatID' method = 'POST'><input type = 'text' name = 'comment'><input type = 'submit' name = 'submitComment' value = {$_POST['commentMsg']}></form>";
            }
            if(isset($_POST['submitComment'])){
                $msgID = $_POST['submitComment'];
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
            reportAdmin($chatID, $auditorComment);
        ?>
    </body>
    </html>
    <?php

}
else if($_SESSION['userRole'] === 'hr'){
    ?>
    <script>
        $(document).ready(function(){
            load(2)
        })
    </script>
    <body>
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
        <form method = "POST" action="">
            <input type="hidden" name="adminID" value="<?php echo $adminID;?>">
            <input type="hidden" name="auditorComment" value="<?php echo $comment;?>">
            <input type = "submit" name="penalty" value="ADD PENALTY">
        </form>
        <?php
            if(isset($_POST['penalty'])){
                $sql = "UPDATE Warnings SET report = '1' WHERE chatID = '$chatID'";
                $conn->query($sql);
            }
        ?>
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
                            $('#div1').append('<h1>'+msg2+'</h1>');
                            $('#message').val('');
                        }
                });
        });
    });
    
    </script>
</head>
<body>
    <div id="div1"></div>
    <input type="text" id="message">
    <button id="submit">Submit</button>
</body>
</html>
<?php
}
function reportAdmin($chatID, $auditorComment){
    echo "<form method='post' action=''>
    <input type='hidden' name='reportComment' value = '$auditorComment'>
    <input type='hidden' name='reportChatID' value = '$chatID'>
    <input type = 'submit' name='report' value = 'report Admin'>
    </form>";
}
if(isset($_POST['report'])){
    $conn = new mysqli("localhost","root","","project");
    $sql = "SELECT receiverID from chat where chatID = '$chatID'";
                $result=$conn->query($sql) or die("Error: ".$conn->error);
                $admin = '';
                if($row = $result->fetch_assoc()){
                    $admin = $row['receiverID'];
                }
    
    $sql = "INSERT INTO Warnings(userID,chatID,report) VALUES ('$admin','$chatID','0')";
    $conn->query($sql) or die("Error: ".$conn->error);
}
?>