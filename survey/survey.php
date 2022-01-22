<?php session_start();
include_once '../errorHandler/errorHandlers.php';
// set_error_handler("customError",E_ALL);
$conn = new mysqli("localhost","root","","project");
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="../styles/surveyStyle.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <title>Sightscapes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
    <body>
    <?php
    include_once "../users/checkLogin.php";
    checkLogin();
    $surveys=unserialize($_GET['surveys'])
    ?>
        <div class="sidenav">
            <form method = "POST" action="">
                <?php
                    foreach($surveys as $s){
                    $sql="SELECT * FROM survey WHERE surveyID='$s' and isOpen='1'";
                    $result=$conn->query($sql);
                    $row=$result->fetch_assoc();
                    if($row['surveyType']=='Satisfaction Survey'){
                        echo "<a style = 'color: white; margin-bottom:30px;' href='survey1.php?surveyID=$s'>".$row['surveyType']."</a> <br><br>";
                    }
                    else if($row['surveyType']=='Post-Trip Survey'){
                        $groupSpecified=$row['GroupSpecified'];
                        $sql1="SELECT * FROM groups as g, survey as s WHERE g.GID='$groupSpecified'";
                        $resultt=$conn->query($sql1);
                        $row1=$resultt->fetch_assoc();
                        echo "<a style = 'color: white; ' href='2ndsurvey.php?surveyID=$s' >".$row['surveyType']."</a> 
                        <h6 style='color:white; text-align:center; font-size:13px; cursor:default; margin-bottom:20px;'> About your trip to ".$row1['loc']."</h6>";
                    }
                } ?>
            </form>
        </div>
        <div class='main'>
            <h1 style="text-align: center; font-size: 30px; cursor:default;">Welcome, <?php echo $_SESSION['FName'];?>.<br>Help us improve our service by answering the following survey(s) you'll find on the left panel.</h1>
        </div>
        
    </body>
</html>
