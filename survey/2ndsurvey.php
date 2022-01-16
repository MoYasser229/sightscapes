<link rel="stylesheet" type="text/css" href="../../project/styles/survey.css">
<?php session_start(); ?>
<html>
<body>
<div class="background"></div>
<div class="square"></div>
<form  method ="POST" action = "">
<?php

    $usrn=$_SESSION['ID'];
    echo "<span class = 'background2'><h1> Tell us about your trip to paris on january.. </h1><br></span>";
    $conn=new mysqli("localhost","root","","project");
    if($conn->connect_error)
    die ("cannot connect to the database");

    $surveytype='post-trip survey';
    $startdate='DATE: Auto CURDATE()';
    $enddate='2022-12-31';///////////
    $isOpen=TRUE;

    $query="INSERT IGNORE INTO Survey(surveyType,startDate,endDate,isOpen,questionNo,pages) 
    VALUES('$surveytype','$startdate','$enddate','$isOpen','6','2')";
    $result=$conn->query($query);
    if(!$result)
    die("Error: ".$conn->error);

    include_once 'Qs.php';

    $questionType='post-trip';
    $possibleans='other';

    $sql1 = "SELECT questionText from Question where questionType = '$questionType'";
    $resultq=mysqli_query($conn,$sql1) or die (mysqli_error($conn));
    $qs=mysqli_fetch_all($resultq,MYSQLI_NUM) or die("Error: ".$conn->error);

    include_once 'OAns.php';
    $sql2 = "SELECT offeredAnswerText from offeredAnswer where offeredAnswerType = '$possibleans'";
    $resulta=mysqli_query($conn,$sql2) or die (mysqli_error($conn));
    $ans=mysqli_fetch_all($resulta,MYSQLI_ASSOC) or die("Error: ".$conn->error);
    
    echo "<span class = 'ques1'></b><br><br>".implode($qs[0])."</b><br><br></span>";
    echo "<span class = 'ans1'><p style='display:inline'><i>Not well at all | </i></p></span>";
    for($i=2;$i<7;$i++){
        $j=implode($ans[$i]);
        echo  "<span class = 'ans1'>"."<input type='radio' name='q1' value='$j'> $j | "."</span>";
    }
    echo "<span class = 'ans1'><p style='display:inline'><i>  Extremely well</i></p></span>";

    echo "<span class = 'ques1'></b><br><br>".implode($qs[1])."</b><br><br></span>";
    echo "<span class = 'ans1'><p style='display:inline'><i>Not well at all | </i></p></span>";
    for($i=2;$i<7;$i++){
        $j=implode($ans[$i]);
        echo  "<span class = 'ans1'>"."<input type='radio' name='q2' value='$j'> $j | "."</span>";
    }
    echo "<span class = 'an1s'><p style='display:inline'><i>  Extremely well</i></p></span>";

    echo "<span class = 'ques1'></b><br><br>".implode($qs[2])."</b><br><br></span>";
    echo "<span class = 'ans1'><p style='display:inline'><i>Not well at all | </i></p></span>";
    for($i=2;$i<7;$i++){
        $j=implode($ans[$i]);
        echo  "<span class = 'ans1'>"."<input type='radio' name='q3' value='$j'> $j | "."</span>";
    }
    echo "<span class = 'ans1'><p style='display:inline'><i>  Extremely well</i></p></span>";

    echo "<span class = 'ques1'></b><br><br>".implode($qs[3])."</b><br><br></span>";
    echo "<span class = 'ans1'><p style='display:inline'><i>Not well at all | </i></p></span>";
    for($i=2;$i<7;$i++){
        $j=implode($ans[$i]);
        echo  "<span class = 'ans1'>"."<input type='radio' name='q4' value='$j'> $j | "."</span>";
    }
    echo "<span class = 'ans1'><p style='display:inline'><i>  Extremely well</i></p></span>";
    
    echo "<span class = 'ques1'></b><br><br>".implode($qs[4])."</b><br><br></span>";
    echo "<span class = 'ans1'><p style='display:inline'><i>Not well at all | </i></p></span>";
    for($i=2;$i<7;$i++){
        $j=implode($ans[$i]);
        echo  "<span class = 'ans1'>"."<input type='radio' name='q5' value='$j'> $j | "."</span>";
    }
    echo "<span class = 'ans1'><p style='display:inline'><i>  Extremely well</i></p></span>";

    echo "<span class = 'ques1'></b><br><br>".implode($qs[5])."</b><br><br></span>";
    echo "<span class = 'ans1'><p style='display:inline'><i>Not well at all | </i></p></span>";
    for($i=2;$i<7;$i++){
        $j=implode($ans[$i]);
        echo  "<span class = 'ans1'>"."<input type='radio' name='q6' value='$j'> $j | "."</span>";
    }
    echo "<span class = 'ans1'><p style='display:inline'><i>  Extremely well</i></p></span>";
    echo  "<span class = 'B2'>"."<input type='submit' name='submit' value='Next'></span>";

    if(isset($_POST['submit'])===TRUE){ 
        if(isset($_POST['q1']))
        $GLOBALS['q1']=$_POST['q1'];
        if(isset($_POST['q2']))
        $GLOBALS['q2']=$_POST['q2'];
        if(isset($_POST['q3']))
        $GLOBALS['q3']=$_POST['q3'];
        if(isset($_POST['q4']))
        $GLOBALS['q4']=$_POST['q4'];
        if(isset($_POST['q5']))
        $GLOBALS['q5']=$_POST['q5'];
        if(isset($_POST['q6']))
        $GLOBALS['q6']=$_POST['q6'];

        for($i=0;$i<count($qs);$i++){
            $qv=implode($qs[$i]);
            $ansv=($i==0)?$GLOBALS['q1']:(($i==1)?$GLOBALS['q2']:(($i==2)?$GLOBALS['q3']:(($i==3)?$GLOBALS['q4']:(($i==4)?$GLOBALS['q5']:$GLOBALS['q6']))));
            
            if($ansv==null){
                echo "<h4> Please submit the required fields. <h4>";
                ?><script>
                    document.getElementById("form").reset();
                </script><?php
                break;
            }
            else{
                $query="INSERT INTO answer(surveyID,questionID,offeredAnswerID,userID) 
                SELECT surveyID, questionID, offeredAnswerID, userID
                FROM survey,question,offeredAnswer,Users WHERE surveyType='$surveytype' 
                AND questiontext='$qv' AND 
                offeredAnswerText='$ansv' AND userID='$usrn'
                AND NOT EXISTS (SELECT * from answer WHERE questionID = (SELECT questionID from question where questionText = '$qv') 
                and (userID = $usrn) and (surveyID = (SELECT surveyID from survey where surveyType = '$surveytype')) );";
                $rs=$conn->query($query);
                if(!$rs)
                die("Error: ".$conn->error);

                $query1="UPDATE answer SET offeredAnswerID =
                (SELECT offeredAnswerID from offeredAnswer where offeredAnswerText='$ansv')
                WHERE (surveyID = (SELECT surveyID from survey where surveyType = '$surveytype')) and
                (questionID = (SELECT questionID from question where questionText = '$qv'))and
                (userID = $usrn);";
                $rs1=$conn->query($query1);
                if(!$rs1)
                die("Error: ".$conn->error);
                header("Location: survey4.php?surveytype=$surveytype", true, 301);
            }
        }
            
    }
$conn->close();
?>
</form>
</body>
</html>