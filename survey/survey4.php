<link rel="stylesheet" type="text/css" href="../../project/styles/survey.css">
<?php
session_start();
?>
<html>
<body>
<form  method ="POST" action = "">
<?php
    ///
    $usrn=$_SESSION['ID'];
    ///
    echo "<span class = 'background2'><h1> Lastly... </h1></span>";
    
    $conn=new mysqli("localhost","root","","project");
    if($conn->connect_error)
    die ("cannot connect to the database");

    $surveytype=$_GET['surveytype'];
    $possibleans='other';

    $sql1 = "SELECT questionText from Question where questionType = '$possibleans'";
    $resultq=mysqli_query($conn,$sql1) or die (mysqli_error($conn));
    $qs=mysqli_fetch_all($resultq,MYSQLI_NUM) or die("Error: ".$conn->error);

    echo "<span class = 'ques'></b><br><br>".implode($qs[1])."</b><br><br></span>";
    echo "<span class = 'ans'><input type='text' name='otherfeedback' value=''></span>";
    echo  "<span class = 'B3'>"."<input type='submit' name='submittt' value='Next'></span>";
    
    if(isset($_POST['Submittt'])===TRUE){ 
        if(isset($_POST['otherfeedback'])){
            $GLOBALS['otherfeedback']=$_POST['otherfeedback'];
        }
        
        $q=implode($qs[1]);
        
        $ansv=$GLOBALS['otherfeedback'];
        if($ansv!=null){
            $query="INSERT IGNORE INTO answer(otherText,surveyID,questionID,offeredAnswerID,userID)
            VALUES( '$ansv',(SELECT surveyID FROM survey where surveyType='$surveytype'),
            (SELECT questionID FROM question WHERE questiontext='$q' ),
            (SELECT offeredAnswerID FROM offeredAnswer WHERE offeredAnswerText='none'),
            (SELECT userID FROM Users WHERE userID ='$usrn'));";
            $rs=$conn->query($query);
            if(!$rs)
            die("Error: ".$conn->error);

            $query1="UPDATE answer SET otherText = '$ansv'
            WHERE (offeredAnswerID=(SELECT offeredAnswerID from offeredAnswer where offeredAnswerText='none')) and
            (surveyID = (SELECT surveyID from survey where surveyType = '$surveytype')) and
            (questionID = (SELECT questionID from question where questionText = '$q'))and
            (userID = $usrn);";
            $rs1=$conn->query($query1);
            if(!$rs1)
            die("Error: ".$conn->error);
        }
        ?>
        <script type="text/javascript">
            document.body.innerHTML = '';
        </script> </form></body>
    <body>
    <?php
    echo "<h1>Thank you for your feedback!</h1>";
    echo "<br><a href='../../project/home.php'> return to homepage </a>";
    }
    $conn->close();
?>
</body>
</html>