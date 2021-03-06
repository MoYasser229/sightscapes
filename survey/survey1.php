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
<h2> Before we start... </h2><p>(<i>optional</i>)</p><br>
</div>
<div class="square">
<form  method ="POST" action = "">
<?php

    $id=$_SESSION['ID'];
    echo "<br><br><br>";
    echo "<span class = 'background1'></span>";
    $conn=new mysqli("localhost","root","","project");
    if($conn->connect_error)
    die ("cannot connect to the database");

    $surveyID=$_GET["surveyID"];

    include_once 'Qs.php';

    $questionType='demographics';
    $possibleans='other';

    $sql1 = "SELECT questionText from Question where questionType = '$questionType'";
    $resultq=mysqli_query($conn,$sql1) or die (mysqli_error($conn));
    $qs=mysqli_fetch_all($resultq,MYSQLI_NUM) or die("Error: ".$conn->error);

    include_once 'OAns.php';
    $sql2 = "SELECT offeredAnswerText from offeredAnswer where offeredAnswerType = '$questionType' or offeredAnswerType = '$possibleans'";
    $resulta=mysqli_query($conn,$sql2) or die (mysqli_error($conn));
    $ans=mysqli_fetch_all($resulta,MYSQLI_ASSOC) or die("Error: ".$conn->error);
    
    echo "<br><b>".implode($qs[0])."</b><br>";
    for($i=0;$i<5;$i++){
        $j=implode($ans[$i]);
        echo "<input type='radio' name='q1' value= '$j'> $j"."<br>";
    }
    
    echo "<br><br><b>".implode($qs[1])."</b><br> ";
    for($i=5;$i<7;$i++){
        $j=implode($ans[$i]);
        echo "<input type='radio' name='q2' value='$j'> $j"."<br>";
    }

    echo "<br><br><b>".implode($qs[2])."</b><br>";
    for($i=7;$i<9;$i++){
        $j=implode($ans[$i]);
        echo "<input type='radio' name='q3' value='$j'> $j"."</br>";
    }
    echo "<input type='submit' name='submit' value='Next'>";

    if(isset($_POST['submit'])===TRUE){ 
            if(isset($_POST['q1']))
            $GLOBALS['q1']=$_POST['q1'];
            if(isset($_POST['q2']))
            $GLOBALS['q2']=$_POST['q2'];
            if(isset($_POST['q3']))
            $GLOBALS['q3']=$_POST['q3'];

            for($i=0;$i<count($qs);$i++){
            $qv=implode($qs[$i]);
            $ansv=($i==0)?$GLOBALS['q1']:(($i==1)?$GLOBALS['q2']:$GLOBALS['q3']);
           if($ansv!=null){
            $query="INSERT INTO answer(surveyID,questionID,offeredAnswerID,userID) 
                    SELECT surveyID, questionID, offeredAnswerID, userID
                    FROM survey,question,offeredAnswer,Users WHERE surveyID='$surveyID' 
                    AND questiontext='$qv' AND 
                    offeredAnswerText='$ansv' AND userID='$id'
                    AND NOT EXISTS (SELECT * from answer WHERE questionID = (SELECT questionID from question where questionText = '$qv') 
                    and (userID = $id) and (surveyID =  '$surveyID') );";
                    $rs=$conn->query($query);
                    if(!$rs)
                    die("Error: ".$conn->error);

                    $query1="UPDATE answer SET offeredAnswerID =
                    (SELECT offeredAnswerID from offeredAnswer where offeredAnswerText='$ansv')
                    WHERE (surveyID = '$surveyID') and
                    (questionID = (SELECT questionID from question where questionText = '$qv'))and
                    (userID ='$id');";
                    $rs1=$conn->query($query1);
                    if(!$rs1)
                    die("Error: ".$conn->error);
            }}
            header("Location: survey2.php?surveyID=$surveyID");
    }

    $conn->close();
    ?>
</form>
</div>

</body>
</html>