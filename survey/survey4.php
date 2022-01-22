<!-- <link rel="stylesheet" type="text/css" href="../project/styles/survey.css"> -->

<?php
session_start();
?>
<html>
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        
        <title>Sightscape</title>

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
        form{
            margin-top: 20%;
            text-align: center;
        }
    </style>
        <?php  
        include_once"../users/checkLogin.php";
        checkLogin();
        ?>
<form  method ="POST" action = "">
<?php
    $id=$_SESSION['ID'];
    
    echo "<span class = 'background2'><h1> Lastly... </h1></span>";    
    $conn=new mysqli("localhost","root","","project");
    if($conn->connect_error)
    die ("cannot connect to the database");

    $possibleans='other';
    $surveyID=$_GET['surveyID'];

    $sql1 = "SELECT questionText from Question where questionType = '$possibleans'";
    $resultq=mysqli_query($conn,$sql1) or die (mysqli_error($conn));
    $qs=mysqli_fetch_all($resultq,MYSQLI_NUM) or die("Error: ".$conn->error);

    echo "<span class = 'ques'><br><b>".implode($qs[1])."</b><br><br></span>";
    echo "<span class = 'ans'><input type='text' name='otherfeedback' value=''></span>";
    echo "<br><br> <span class = 'B'><input type='submit' name='Submittt' value='Submit'></span>";
    
    if(isset($_POST['Submittt'])===TRUE){ 
        if(isset($_POST['otherfeedback'])){
            $GLOBALS['otherfeedback']=$_POST['otherfeedback'];
        }
        
        $q=implode($qs[1]);
        
        $ansv=$GLOBALS['otherfeedback'];
        if($ansv!=null){
            $query="INSERT IGNORE INTO answer(otherText,surveyID,questionID,offeredAnswerID,userID)
            VALUES( '$ansv','$surveyID',
            (SELECT questionID FROM question WHERE questiontext='$q' ),
            (SELECT offeredAnswerID FROM offeredAnswer WHERE offeredAnswerText='none'),
            (SELECT userID FROM Users WHERE userID ='$id'));";
            $rs=$conn->query($query);
            if(!$rs)
            die("Error: ".$conn->error);

            $query1="UPDATE answer SET otherText = '$ansv'
            WHERE (offeredAnswerID=(SELECT offeredAnswerID from offeredAnswer where offeredAnswerText='none')) and
            (surveyID =  '$surveyID') and
            (questionID = (SELECT questionID from question where questionText = '$q'))and
            (userID = $id);";
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
        header("Location: ../home/home.php");
    }
    $conn->close();
?>
</body>
</html>