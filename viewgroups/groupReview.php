<?php
$userID = 0;
if(!empty($_POST['userID']))
  $userID = $_POST['userID'];
$id = $_POST['gid'];
$conn = new mysqli("localhost" , "root" , "" , "project");
if($userID === 0){
    echo "<script> alert('You have to sign in to add review') </script>";
  }
  else if(empty($_POST['reviewText'])){
    echo "<script> alert('Review Message is empty') </script>";
  }
  else{
    $sqlCheck = "SELECT * FROM reviews WHERE userID = '$userID'";
    $result = $conn->query($sqlCheck);
    if($row5 = $result->fetch_assoc()){
      echo "<script> alert('You can only add one review') </script>";
    }
    else{
      $reviewText=$_POST['reviewText'];
      $sql2 = "SELECT * FROM users WHERE userID = $userID";
      $result2 = $conn->query($sql2);
      if($row = $result2->fetch_assoc()){
        echo "<div style='background-color: #173c4e; margin-right: 100px; padding: 10px;'><img src = '../users/images/{$row['pic']}' width = 100 height = 100>&nbsp{$row['fname']} {$row['lname']}<br>$reviewText</div>";
      }
      
      $sql="INSERT INTO reviews(GID,userID,reviewText) VALUES ((SELECT GID FROM groups WHERE GID='$id'),
      (SELECT userID FROM Users WHERE userID='$userID'),'$reviewText')";
      $result=mysqli_query($conn,$sql) or die($conn->error);
    }
  }
?>