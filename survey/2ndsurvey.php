<link rel="stylesheet" type="text/css" href="../../project/styles/survey.css">
<?php session_start(); 
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

<form  method ="POST" action = "">
<?php
    $id=$_SESSION['ID'];
    $conn=new mysqli("localhost","root","","project");
    if($conn->connect_error)
    die ("cannot connect to the database");

    $surveyID=$_GET["surveyID"];
    $sql="SELECT g.loc, g.departureTime FROM groups as g, survey as s WHERE s.GroupSpecified=g.GID and s.surveyID='$surveyID' ";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    $departureTime=date("F Y",strtotime($row["departureTime"]));
    echo "<div class='backgroundSquare'><h1> Tell us about your trip to ".$row['loc']." on ".$departureTime.".. </h1><br><br></div>";
    include_once 'Qs.php';

    $questionType='Post-Trip';
    $possibleans='other';

    $sql1 = "SELECT questionText from Question where questionType = '$questionType'";
    $resultq=mysqli_query($conn,$sql1) or die (mysqli_error($conn));
    $qs=mysqli_fetch_all($resultq,MYSQLI_NUM) or die("Error: ".$conn->error);

    include_once 'OAns.php';
    $sql2 = "SELECT offeredAnswerText from offeredAnswer where offeredAnswerType = '$possibleans'";
    $resulta=mysqli_query($conn,$sql2) or die (mysqli_error($conn));
    $ans=mysqli_fetch_all($resulta,MYSQLI_ASSOC) or die("Error: ".$conn->error);
    echo "<div class='square'>";
    
    echo "<span class = 'ques1'><b>".implode($qs[0])."</b><br><br></span>";
    echo "<span class = 'ans1'><p style='display:inline'><i>Not well at all | </i></p></span>";
    for($i=2;$i<7;$i++){
        $j=implode($ans[$i]);
        echo "<span class = 'ans1'><input type='radio' name='q1' value='$j'> $j | "."</span>";
    }
    echo "<span class = 'ans1'><p style='display:inline'><i>  Extremely well</i></p></span>";

    echo "<span class = 'ques1'><br><br><b>".implode($qs[1])."</b><br><br></span>";
    echo "<span class = 'ans1'><p style='display:inline'><i>Not well at all | </i></p></span>";
    for($i=2;$i<7;$i++){
        $j=implode($ans[$i]);
        echo "<span class = 'ans1'><input type='radio' name='q2' value='$j'> $j | "."</span>";
    }
    echo "<span class = 'ans1'><p style='display:inline'><i>  Extremely well</i></p></span>";

    echo "<span class = 'ques1'><br><br><b>".implode($qs[2])."</b><br><br></span>";
    echo "<span class = 'ans1'> <p style='display:inline'><i>Not well at all | </i></p></span>";
    for($i=2;$i<7;$i++){
        $j=implode($ans[$i]);
        echo "<span class = 'ans1'> <input type='radio' name='q3' value='$j'> $j | "."</span>";
    }
    echo "<span class = 'ans1'><p style='display:inline'><i>  Extremely well</i></p></span>";

    echo "<span class = 'ques1'><br><br><b>".implode($qs[3])."</b><br><br></span>";
    echo "<span class = 'ans1'><p style='display:inline'><i>Not well at all | </i></p></span>";
    for($i=2;$i<7;$i++){
        $j=implode($ans[$i]);
        echo "<span class = 'ans1'><input type='radio' name='q4' value='$j'> $j | "."</span>";
    }
    echo "<span class = 'ans1'><p style='display:inline'><i>  Extremely well</i></p></span>";
    
    echo "<span class = 'ques1'><br><br><b>".implode($qs[4])."</b><br><br></span>";
    echo "<span class = 'ans1'><p style='display:inline'><i>Not well at all | </i></p></span>";
    for($i=2;$i<7;$i++){
        $j=implode($ans[$i]);
        echo "<span class = 'ans1'>"."<input type='radio' name='q5' value='$j'> $j | "."</span>";
    }
    echo "<span class = 'ans1'><p style='display:inline'><i>  Extremely well</i></p></span>";

    echo "<span class = 'ques1'><br><br><b>".implode($qs[5])."</b><br><br></span>";
    echo "<span class = 'ans1'><p style='display:inline'><i>Not well at all | </i></p></span>";
    for($i=2;$i<7;$i++){
        $j=implode($ans[$i]);
        echo "<span class = 'ans1'>"."<input type='radio' name='q6' value='$j'> $j | "."</span>";
    }
    echo "<span class = 'ans1'><p style='display:inline'><i>  Extremely well</i></p></span>";
    echo "<br><span class = 'B'> <input type='submit' name='submit' value='Next'></span>";

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
                FROM survey,question,offeredAnswer,Users WHERE surveyID='$surveyID' 
                AND questiontext='$qv' AND 
                offeredAnswerText='$ansv' AND userID='$id'
                AND NOT EXISTS (SELECT * from answer WHERE questionID = (SELECT questionID from question where questionText = '$qv') 
                and (userID = $id) and (surveyID ='$surveyID' ));";
                $rs=$conn->query($query);
                if(!$rs)
                die("Error: ".$conn->error);

                $query1="UPDATE answer SET offeredAnswerID =
                (SELECT offeredAnswerID from offeredAnswer where offeredAnswerText='$ansv'),completionStatus='1'
                WHERE (surveyID = '$surveyID' ) and
                (questionID = (SELECT questionID from question where questionText = '$qv'))and
                (userID = '$id');";
                $rs1=$conn->query($query1);
                if(!$rs1)
                die("Error: ".$conn->error);
                echo "<script>window.location.replace('survey4.php?surveyID=$surveyID');</script>";
            }
        }     
    }
$conn->close();
?>
</form>
</div>
</body>
</html>