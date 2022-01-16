<style>
    .audForm{
        display: flex;
        justify-content: center;
    }
    .audForm button{
        border: none;
        background-color: goldenrod;
        color: white;
        padding: 10px;
        margin-left: 10px;
        border-radius: 14px;
    }
    .textForm{
        height: 75px;
        width: 90%;
        font-size: 30px;
        border-radius: 14px;
    }
</style>
<?php
$conn = new mysqli("localhost" , "root" , "" , "project");
$getChatIDQuery = "SELECT chatID FROM msg WHERE msgID = '{$_POST['messageID']}'";
$getChatIDResult = $conn->query($getChatIDQuery) or die($conn->error);
$chatID = '';
if($getChatIDRow = $getChatIDResult->fetch_assoc())
    $chatID = $getChatIDRow['chatID'];
$messageID = $_POST['messageID'];
$auditorComment = '';
    echo "<form class = 'audForm' action = 'chat.php?chatID=$chatID' method = 'POST'><input class = 'textForm' type = 'text' name = 'comment'><button type = 'submit' name = 'submitComment' value = $messageID>COMMENT</button></form>";
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
    //reportAdmin($chatID, $auditorComment);
?>