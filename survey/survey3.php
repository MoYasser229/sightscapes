<link rel="stylesheet" type="text/css" href="../styles/survey.css">
<?php
session_start();
include_once '../errorHandler/errorHandlers.php';
set_error_handler('customError',E_ALL);
?>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <title>Sightscapes</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
<body>
<style>
        .background{
                background-color: #0b1d26;
                height: 75px;
        }
    </style>
    <?php  
        include_once"../users/checkLogin.php";
        checkLogin();
    ?>
<div class="backgroundSquare">
<h1> Help us improve our website... </h1><br><br>
</div>
<div class="square">
<form  method ="POST" action = "">
<?php
    $GLOBALS['q1']='';
    $GLOBALS['q2']='';
    $GLOBALS['q3']='';
    ///
    $id=$_SESSION['ID'];
    ///
    
    $conn=new mysqli("localhost","root","","project");
    if($conn->connect_error)
    die ("cannot connect to the database");

    $surveyID=$_GET["surveyID"];
    $questionType='website feedback';
    $possibleans='other';

    $sql1 = "SELECT questionText from Question where questionType = '$questionType' or questionType = '$possibleans'";
    $resultq=mysqli_query($conn,$sql1) or die (mysqli_error($conn));
    $qs=mysqli_fetch_all($resultq,MYSQLI_NUM) or die("Error: ".$conn->error);

    $sql2 = "SELECT offeredAnswerText from offeredAnswer where offeredAnswerType = '$questionType' or offeredAnswerType = '$possibleans'";
    $resulta=mysqli_query($conn,$sql2) or die (mysqli_error($conn));
    $ans=mysqli_fetch_all($resulta,MYSQLI_ASSOC) or die("Error: ".$conn->error);

    echo " <br><b>".implode($qs[0])."</b><br><br> ";
    echo " <p style='display:inline'><i>Not well at all | </i></p> ";
    for($i=2;$i<7;$i++){
        $j=implode($ans[$i]);
        echo "  <input type='radio' name='q1' value='$j'> $j |  ";
    }
    echo " <p style='display:inline'><i>  Extremely well</i></p> ";

    echo " <br><br><b>".implode($qs[1])."</b><br><br> ";
    for($i=0;$i<2;$i++){
        $j=implode($ans[$i]);
        echo  " <input type='radio' name='q2' value='$j'> $j"." ";
    }
    
    echo " <br><br><b>".implode($qs[2])."</b><br><br>  ";
    for($i=0;$i<2;$i++){
        $j=implode($ans[$i]);
        echo " <input type='radio' name='q3' value='$j'> $j"." ";
    }  
    
    echo " <br><br><b>".implode($qs[3])."</b><br><br> ";
    echo " <input type='text' name='issuesfaced' value=''> ";
    echo " <br><br> <input type='submit' name='Submitt' value='Next'> ";
    
    if(isset($_POST['Submitt'])===TRUE){ 
        if(isset($_POST['q1'])&&isset($_POST['q2'])&&isset($_POST['q3'])){
            $GLOBALS['q1']=$_POST['q1'];
            $GLOBALS['q2']=$_POST['q2'];
            $GLOBALS['q3']=$_POST['q3'];
        }
        if(isset($_POST['issuesfaced'])){
            $GLOBALS['issuesfaced']=$_POST['issuesfaced'];
        }
      for($i=0;$i<count($qs)-1;$i++){
        $qv=implode($qs[$i]);
        $ansv=($i==0)?$GLOBALS['q1']:(($i==1)?$GLOBALS['q2']:(($i==2)?$GLOBALS['q3']:$GLOBALS['issuesfaced']));
        $move=true;
        if($ansv==null&&$i!=3){
            echo "<h4> Please submit the required fields. <h4>";
            ?><script>
                document.getElementById("form").reset();
            </script><?php
            $move=false;
            break;
        }
        else if(($i==0||$i==1||$i==2)&& $ansv!=null){
            $query="INSERT INTO answer(surveyID,questionID,offeredAnswerID,userID) 
            SELECT surveyID, questionID, offeredAnswerID, userID
            FROM survey,question,offeredAnswer,Users WHERE surveyID='$surveyID' 
            AND questiontext='$qv' AND 
            offeredAnswerText='$ansv' AND userID='$id'
            AND NOT EXISTS (SELECT * from answer WHERE questionID = (SELECT questionID from question where questionText = '$qv') 
            and (userID = '$id') and (surveyID = '$surveyID') );";
            $rs=$conn->query($query);
            if(!$rs)
            die("Error: ".$conn->error);

            $query1="UPDATE answer SET offeredAnswerID =
            (SELECT offeredAnswerID from offeredAnswer where offeredAnswerText='$ansv'), completionStatus='1'
            WHERE (surveyID ='$surveyID') and
            (questionID = (SELECT questionID from question where questionText = '$qv'))and
            (userID = $id);";
            $rs1=$conn->query($query1);
            if(!$rs1)
            die("Error: ".$conn->error);
        }
       else if($i==3&&$ansv!=null){
        $query="INSERT IGNORE INTO answer(otherText,surveyID,questionID,offeredAnswerID,userID,completionStatus)
        VALUES( '$ansv',('$surveyID'),
        (SELECT questionID FROM question WHERE questiontext='$qv' ),
        (SELECT offeredAnswerID FROM offeredAnswer WHERE offeredAnswerText='none'),
        (SELECT userID FROM Users WHERE userID ='$id'),'1');";
        
        $rs=$conn->query($query);
        if(!$rs) die("Error: ".$conn->error);

        $query1="UPDATE answer SET otherText = '$ansv'
        WHERE (offeredAnswerID=(SELECT offeredAnswerID from offeredAnswer where offeredAnswerText='none')) and
        (surveyID = '$surveyID') and
        (questionID = (SELECT questionID from question where questionText = '$qv'))and
        (userID ='$id');";
        $rs1=$conn->query($query1) or die("Error: ".$conn->error);
       }
    }

    if($move==true) header("Location: survey4.php?surveyID=$surveyID");

}
    $conn->close();
?>
</form>
</div>


</body>
</html>