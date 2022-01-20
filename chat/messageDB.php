
<?php 
    session_start();
    $id=$_SESSION['ID'];
    $conn=new mysqli("localhost","root","","project");
    if(isset($_POST['msgText']))
    {
        $chatID=$_POST['chatID'];
        $chatType=$_POST['chatType'];
        $admin=$_POST['admin'];
        if($admin === $id)
            echo "<span class = 'textMessageAdmin'>{$_POST['msgText']}</span>";
        else
            echo "<span class = 'textMessage'>{$_POST['msgText']}</span>";
        echo "<br><br><br>";
        $msg=($_POST['msgText']?$_POST['msgText']:'');

            // chatID
            if($chatID!='')
            {
                $sql = "INSERT INTO msg(msgText,seen,chatID,recieverID,senderID) VALUES ('$msg','0','$chatID','$admin','$id')";
                $result=$conn->query($sql) or die("Error: ".$conn->error);
            }
            else
            {   
                $sql = "SELECT receiverID,senderID,chatID 
                FROM chat 
                WHERE chatID = (SELECT chatID FROM chat 
                    WHERE senderID='$id' 
                    and receiverID='$admin' 
                    and chatType='$chatType' 
                    and createdAt=(SELECT createdAt 
                        from chat 
                        where senderID='$id' 
                        and receiverID= '$admin' 
                        and chatType='$chatType' 
                        ORDER BY createdAt DESC LIMIT 1)
                )
                ";
                $resultReciever = $conn->query($sql) or die("Error: ".$conn->error);
                $recieverID = '';
                $senderID = '';
                if($rowReciever = $resultReciever->fetch_assoc()){
                        $senderID = $rowReciever['senderID'];
                        $recieverID = $rowReciever['receiverID'];
                        $chatID = $rowReciever['chatID'];
                }
                $sql = "INSERT INTO msg(msgText,seen,chatID,senderID,recieverID) VALUES ('$msg','0','$chatID','$senderID','$recieverID')";
                $result=$conn->query($sql) or die("$recieverID <- $senderID ErrorR: ".$conn->error);
            }

            
        // else if($chatID==''){
        //     //session//auditor
        // }
        // else{

        // }
    }
    else if(isset($_POST['loc'])&&$_POST['checkForm']==true){
        $admin=$_POST['admin'];
        //<?php echo "chat.php?admin=$admin&chatType=Group Recommendation"
        $sql = "INSERT INTO chat(senderID,receiverID,chatType)
        VALUES ((SELECT userID from Users where userID='$id'),
        '$admin','Group Recommendation');";
        $result=$conn->query($sql) or die("Error: ".$conn->error);
        $chatType=$_POST['chatType'];
        $loc=$_POST['loc'];
        $desc=$_POST['desc'];
        $link=$_POST['link'];
        $pic = $_POST['pic'];
        $sql = "INSERT INTO groupRec(pic,link,descrip,userID) VALUES ('$pic','$link','$desc','$id')";
        $result=$conn->query($sql) or die("Error: ".$conn->error);
        $loc="Location: ".$_POST['loc'];
        $desc="Description: ".$_POST['desc'];
        $link="Link: ".$_POST['link'];
        $pic="Picture: ".$_POST['pic'];
        $sql = "INSERT INTO msg(msgText,seen,recieverID,senderID,chatID)
                VALUES ('$loc','0','$admin','$id',(SELECT chatID FROM chat WHERE senderID='$id' and
                receiverID='$admin' and chatType='$chatType' and createdAt=(SELECT createdAt from chat where
                senderID='$id' and receiverID= '$admin' and chatType='$chatType' ORDER BY createdAt DESC LIMIT 1))),
                ('$desc','0','$admin','$id',(SELECT chatID FROM chat WHERE senderID='$id' and
                receiverID='$admin' and chatType='$chatType' and createdAt=(SELECT createdAt from chat where
                senderID='$id' and receiverID= '$admin' and chatType='$chatType' ORDER BY createdAt DESC LIMIT 1))),
                ('$link','0','$admin','$id',(SELECT chatID FROM chat WHERE senderID='$id' and
                receiverID='$admin' and chatType='$chatType' and createdAt=(SELECT createdAt from chat where
                senderID='$id' and receiverID= '$admin' and chatType='$chatType' ORDER BY createdAt DESC LIMIT 1))),
                ('$pic','0','$admin','$id',(SELECT chatID FROM chat WHERE senderID='$id' and
                receiverID='$admin' and chatType='$chatType' and createdAt=(SELECT createdAt from chat where
                senderID='$id' and receiverID= '$admin' and chatType='$chatType' ORDER BY createdAt DESC LIMIT 1)))";
                $result=$conn->query($sql) or die("Error: ".$conn->error);

                $getChatIDQuery = "SELECT chatID FROM chat WHERE senderID='$id' and
                receiverID='$admin' and chatType='$chatType' and createdAt=(SELECT createdAt from chat where
                senderID='$id' and receiverID= '$admin' and chatType='$chatType' ORDER BY createdAt DESC LIMIT 1)";
                $getChatIDResult = $conn->query($getChatIDQuery);
                if($chatIDRow = $getChatIDResult->fetch_assoc()){
                    $chatID = $chatIDRow['chatID'];
                    $sql = "SELECT * FROM msg WHERE chatID ='$chatID'";
                    $result=$GLOBALS['conn']->query($sql) or die("Error: ".$GLOBALS['conn']->error);
                    echo "<div class='messageContainerAuditor'>";
                    while($row=$result->fetch_assoc()){
                        if(str_contains($row['msgText'],'Picture:')){
                            $picture = substr($row['msgText'],9,strlen($row['msgText']));
                            echo "<div class = 'textMessage'><img src = 'images/$picture' width='300' height='300'></div><br>";
                        }
                        else
                            echo "<div class = 'textMessage'>{$row['msgText']}</div><br>";}
                   
                }
    }
    else{
            DisplayMessages();
    }
    function DisplayMessages(){
        $chatID=$_POST['chatID'];
        $admin=$_POST['admin'];
        $sql = "SELECT * FROM msg WHERE chatID ='$chatID'";
        $result=$GLOBALS['conn']->query($sql) or die("Error: ".$GLOBALS['conn']->error);
        
        if(isset($_POST['auditor'])){
                //echo "<form action = 'chat.php?chatID=$chatID' method = 'POST' id = 'commentForm'>";
                echo "<div class='messageContainerAuditor'>";
                while($row=$result->fetch_assoc()){
                    if(isset($_POST['auditor'])){
                        if($_POST['auditor'] === '1' || $_POST['auditor'] === '2'){
                            $checkAdmin = "SELECT receiverID FROM chat WHERE chatID = '$chatID'";
                            $checkAdminResult = $GLOBALS['conn']->query($checkAdmin);
                            if($checkAdminRow = $checkAdminResult->fetch_assoc()){
                                if($checkAdminRow['receiverID'] === $row['senderID']){
                                    if($_POST['auditor'] === '1'){
                                        if(empty($row['auditorComment']))
                                            echo "<div class = 'textMessageAdmin'>{$row['msgText']}<input type='hidden' name = 'commentMsg' value = '{$row['msgID']}'><button onclick = 'onClick(this.id)'  class='auditorButton' type='submit' name = 'submitComment' id = '{$row['msgID']}'><i class='fas fa-pencil-alt'></i></button></div><br><br><br>";
                                        else
                                            echo "<div class = 'textMessageAdmin'>{$row['msgText']}<input type='hidden' name = 'commentMsg' value = '{$row['msgID']}'><button onclick = 'onClick(this.id)' class='auditorButton' type='submit' name = 'submitComment' id = '{$row['msgID']}'><i class='fas fa-pencil-alt'></i></button></div><br><br><br><p class = 'textMessageAuditor'>{$row['auditorComment']}</p><br><br><br>";
                                        echo "<div id='divAuditor' class='fixed-bottom'></div>";
                                    }
                                    else if($_POST['auditor'] === '2'){
                                        if(empty($row['auditorComment']))
                                            echo "<div class = 'textMessageAdmin'>{$row['msgText']}<input type='hidden' name = 'commentMsg' value = '{$row['msgID']}'></div><br><br><br>";
                                        else
                                            echo "<div class = 'textMessageAdmin'>{$row['msgText']}<input type='hidden' name = 'commentMsg' value = '{$row['msgID']}'></div><br><br><br><p class = 'textMessageAuditor'>{$row['auditorComment']}</p><br><br><br>";
                                    }
                                    }
                                else{
                                    if(str_contains($row['msgText'],'Picture:')){
                                        $picture = substr($row['msgText'],9,strlen($row['msgText']));
                                        echo "<div class = 'textMessage'><img src = 'images/$picture' width='300' height='300'></div><br>";
                                    }
                                    else
                                        echo "<div class = 'textMessage'>{$row['msgText']}</div><br>";
                                }
                            } 
                        }
                        else{
                            //if($row[''])
                            if($row['senderID'] === $admin)
                                echo "<div class = 'textMessageAdmin'>{$row['msgText']}</div><br><br><br>";
                            else{
                                if(str_contains($row['msgText'],'Picture:')){
                                    $picture = substr($row['msgText'],9,strlen($row['msgText']));
                                    echo "<div class = 'textMessage'><img src = 'images/$picture' width='300' height='300'></div><br>";
                                }
                                else
                                    echo "<div class = 'textMessage'>{$row['msgText']}</div><br>";}
                        }
                    }
                }
        }
        echo "</div>";
    }
    
?>
<script>
    function onClick(messageID){
            $.ajax({
                method: 'POST',
                url: 'commentAuditor.php',
                data: {
                    'messageID' : messageID
                },
                success: (result) => {
                    $('#divAuditor').html('<p>'+result+'</p>');
                }
            })
    }
</script>