<link rel="stylesheet" type="text/css" href="../../project/styles/survey.css">
<?php
session_start();
?>
<html>
<body>

<div class="background"></div>
<div class="square"></div>
<form  method ="POST" action = "">
<?php
///survey monkey & add survey


    $usrn=$_SESSION['ID'];
    
    echo "<span class = 'background1'><h1><b>Survey</b></h1></span>";
    echo "<span class = 'background1'><h2 style='display:inline'> Before we start... </h2><p style='display:inline'>(<i>optional</i>)</p><br></span>";
    $conn=new mysqli("localhost","root","","project");
    if($conn->connect_error)
    die ("cannot connect to the database");

    $surveytype='satisfaction survey';
    $startdate='DATE: Auto CURDATE()';
    $enddate='2022-12-31';
    $isOpen=TRUE;

    $query="INSERT IGNORE INTO Survey(surveyType,startDate,endDate,isOpen) 
    VALUES('$surveytype','$startdate','$enddate','$isOpen')";
    $result=$conn->query($query);
    if(!$result)
    die("Error: ".$conn->error);

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
    
   
    echo "<span class = 'ques'></b><br>".implode($qs[0])."</b><br></span>";
    for($i=0;$i<5;$i++){
        $j=implode($ans[$i]);
        echo  "<span class = 'ans0'>"."<input type='radio' name='q1' value='$j'> $j"."</br></span>";
    }
    
    echo "<span class = 'ques'></b><br>".implode($qs[1])."</b><br></span>";
    for($i=5;$i<7;$i++){
        $j=implode($ans[$i]);
        echo  "<span class = 'ans0'>"."<input type='radio' name='q2' value='$j'> $j"."</br></span>";
    }

    echo "<span class = 'ques'></b><br>".implode($qs[2])."</b><br></span>";
    for($i=7;$i<9;$i++){
        $j=implode($ans[$i]);
        echo  "<span class = 'ans0'>"."<input type='radio' name='q3' value='$j'> $j"."</br></span>";
    }
    echo  "<span class = 'B'>"."<input type='submit' name='submit' value='Next'></span>";

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
            }}
            header("Location: survey2.php", true, 301);
    }

    $conn->close();
    ?>
</form>
</body>
</html>