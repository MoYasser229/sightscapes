<?php session_start();
$conn = new mysqli("localhost","root","","project");
?>
<html>
<body>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="../styles/surveyauditor.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <title>Sightscapes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
	<body style="background-color: #071a20;">
    <?php
    include_once "../users/checkLogin.php";
    checkLogin();
    $id=$_SESSION["ID"];
    $surveyType=$_GET["view"];
    $surveyinfo=$_GET["viewinfo"];
    if($surveyType){
        $sql1 = "SELECT surveyID from survey where surveyType = '$surveyType'";
        $result=mysqli_query($conn,$sql1) or die (mysqli_error($conn));
        $row1=$result->fetch_assoc();
        $row1=$row1['surveyID'];
        $sql1 = "SELECT a.surveyID,u.fname,u.lname,q.questionText,oans.offeredAnswerText,a.otherText from Answer as a,users as u,question as q,offeredanswer as oans, survey as s where a.surveyID=s.surveyID and s.surveyType = '$surveyType' and u.userID=a.userID and a.questionID=q.questionID AND a.offeredAnswerID=oans.offeredAnswerID";
        $result=mysqli_query($conn,$sql1) or die (mysqli_error($conn));
        echo "<table class = 'tableClass' ><tr><th>Survey ID</th><th>First Name</th><th>Last Name</th><th> Question</th><th>  Offered Answer</th> <th> Additional Comments</th></tr>";
        while($row=$result->fetch_assoc()){
            $otherText='No Additional Comments.';
            if(!empty($row['otherText'] ))$otherText=$row['otherText'];
            echo "<><td>" .$row['surveyID']. "</td><td>" .$row['fname']. "</td><td>" .$row['lname'] . "</td><td>" .$row['questionText'] . "</td><td>".$row['offeredAnswerText'] . "</td><td>". $otherText. "</td></tr>";
        } 
        echo "</table>";
    }
    
    else if($surveyinfo){
        
        $sql1 = "SELECT surveyID from survey where surveyType = '$surveyinfo'";
        $result=mysqli_query($conn,$sql1) or die (mysqli_error($conn));
        $row1=$result->fetch_assoc();
        $row1=$row1['surveyID'];
        $sql1 = "SELECT surveyID,startDate,endDate,isOpen,GroupSpecified FROM survey WHERE surveyType = '$surveyinfo'";
        $result=mysqli_query($conn,$sql1) or die (mysqli_error($conn));
        if($surveyinfo=='Post-Trip Survey'){
        echo "<table class = 'tableClass' ><tr><th>Survey ID</th><th>Start Date</th><th>End Date</th><th> Status </th><th> Group </th></tr>";
        while($row=$result->fetch_assoc()){
            $open='Closed';
            if($row['isOpen']=='1')$open='Active';
            echo "<tr><td>" .$row['surveyID']. "</td><td>" .$row['startDate']. "</td><td>" .$row['endDate'] . "</td><td>" .$open . "</td><td>".$row['GroupSpecified'] . "</td></tr>";
        } 
        echo "</table>";}
        else{
            echo "<table class = 'tableClass' ><tr><th>Survey ID</th><th>Start Date</th><th>End Date</th><th> Status </th></tr>";
            while($row=$result->fetch_assoc()){
                $open='Closed';
                if($row['isOpen']=='1')$open='Active';
                echo "<tr><td>" .$row['surveyID']. "</td><td>" .$row['startDate']. "</td><td>" .$row['endDate'] . "</td><td>" .$open . "</td></tr>";
            } 
            echo "</table>";
        }
    }
    
    
?>  
</body>
</html>