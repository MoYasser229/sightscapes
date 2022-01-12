<?php session_start(); ?>
<?php
    $id=$_SESSION['ID'];
    $conn=new mysqli("localhost","root","","project");
    if(isset($_POST['msgText']))
    {
        echo $_POST['msgText'];
        $chatID=$_POST['chatID'];
        $chatType=$_POST['chatType'];
        $admin=$_POST['admin'];
        $msg=($_POST['msgText']?$_POST['msgText']:'');

            // msgID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            // msgText varchar(255) NOT NULL,
            // msgTime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            // seen update in receiver's side ig

            // chatID
            if($chatID!='')
            {
                $sql = "INSERT INTO msg(msgText,seen,chatID) VALUES ('$msg','0','$chatID')";
                $result=$conn->query($sql) or die("Error: ".$conn->error);
            }
            else
            {   
                $sql = "INSERT INTO msg(msgText,seen,chatID)
                    VALUES ('$msg','0',(SELECT chatID FROM chat WHERE senderID='$id' and 
                    receiverID='$admin' and chatType='$chatType' and createdAt=(SELECT createdAt from chat where
                    senderID='$id' and receiverID= '$admin' and chatType='$chatType' ORDER BY createdAt DESC LIMIT 1)))";
                $result=$conn->query($sql) or die("Error: ".$conn->error);
            }

            
        // else if($chatID==''){
        //     //session//auditor
        // }
        // else{

        // }
    }
    else if(isset($_POST['loc'])&&$_POST['checkForm']==true){
        $chatType=$_POST['chatType'];
        $admin=$_POST['admin'];
        $loc=$_POST['loc'];
        $desc=$_POST['desc'];
        $link=$_POST['link'];
        $pic=$_POST['pic'];
        $sql = "INSERT INTO groupRec(pic,link,descrip,userID) VALUES ('$pic','$link','$desc','$id')";
        $result=$conn->query($sql) or die("Error: ".$conn->error);
        $loc="Location: ".$_POST['loc'];
        $desc="Description: ".$_POST['desc'];
        $link="Link: ".$_POST['link'];
        $pic="Picture: ".$_POST['pic'];
        $sql = "INSERT INTO msg(msgText,seen,chatID)
                VALUES ('$loc','0',(SELECT chatID FROM chat WHERE senderID='$id' and
                receiverID='$admin' and chatType='$chatType' and createdAt=(SELECT createdAt from chat where
                senderID='$id' and receiverID= '$admin' and chatType='$chatType' ORDER BY createdAt DESC LIMIT 1))),
                ('$desc','0',(SELECT chatID FROM chat WHERE senderID='$id' and
                receiverID='$admin' and chatType='$chatType' and createdAt=(SELECT createdAt from chat where
                senderID='$id' and receiverID= '$admin' and chatType='$chatType' ORDER BY createdAt DESC LIMIT 1))),
                ('$link','0',(SELECT chatID FROM chat WHERE senderID='$id' and
                receiverID='$admin' and chatType='$chatType' and createdAt=(SELECT createdAt from chat where
                senderID='$id' and receiverID= '$admin' and chatType='$chatType' ORDER BY createdAt DESC LIMIT 1))),
                ('$pic','0',(SELECT chatID FROM chat WHERE senderID='$id' and
                receiverID='$admin' and chatType='$chatType' and createdAt=(SELECT createdAt from chat where
                senderID='$id' and receiverID= '$admin' and chatType='$chatType' ORDER BY createdAt DESC LIMIT 1)))";
                $result=$conn->query($sql) or die("Error: ".$conn->error);
                DisplayMessages();
    }
    else{
        DisplayMessages();
    }
    function DisplayMessages(){
        $chatID=$_POST['chatID'];
        $sql = "SELECT * FROM msg WHERE chatID ='$chatID'";
        $result=$GLOBALS['conn']->query($sql) or die("Error: ".$GLOBALS['conn']->error);
        
        if(isset($_POST['auditor']))
            if($_POST['auditor'] === '1')
                echo "<form action = 'chat.php?chatID=$chatID' method = 'POST' id = 'commentForm'>";
        while($row=$result->fetch_assoc()){
            
            if(isset($_POST['auditor'])){
                if($_POST['auditor'] === '1')
                //<a href = '' id = 'commentForm' value = '{$row['msgID']}'>COMMENT</a>
                    echo "{$row['msgText']} <p style = 'color: gray'>{$row['auditorComment']}</p><input type='radio' name = 'commentMsg' value = '{$row['msgID']}'>";
                else
                    echo $row['msgText'];
            }
            echo "<br>";
        }
        if(isset($_POST['auditor'])){
            if($_POST['auditor'] === '1'){
                echo "<input type = 'submit' name = 'submit'>";
                echo "</form>";
            }
        }
        
    }
    
?>