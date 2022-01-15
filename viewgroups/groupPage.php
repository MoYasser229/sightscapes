<?php 
session_start();
?>
<html>
<body>
<table border =1>
<tr> <th> price </th> <th> avgrating </th>  <th> loc </th> <th> departureTime </th> 
<th> arrivalTime </th> <th> descrip </th> <th> difflevel </th> <th> grpsize </th> <th> distance </th>
<th> tripLength </th> <th> createdAt </th> <th> modifiedAt </th> <th> pic </th> </tr>
<?php
$hn='localhost';
$db='project';
$un='root';
$pw='';

$id=$_GET['GID'];
$userID=$_SESSION['ID'];
//require_once 'login.php'; //gets php code from another file
$conn=new mysqli("localhost","$un","$pw","$db") or die ("fatal error cannot connect to DB");
$sql = "SELECT * FROM groups WHERE GID = $id";
 //preperation for query
$result=$conn->query($sql) or die ("fatal error in executing code");
if($row= $result->fetch_array(MYSQLI_ASSOC)){
echo "<tr> <td> ".$row['price']."</td>";
echo "<td> ".$row['avgrating']."</td>";
echo " <td> ".$row['loc']."</td>";
echo " <td> ".$row['departureTime']."</td>";
echo "<td> ".$row['arrivalTime']."</td>";
echo "<td> ".$row['descrip']."</td>";
echo "<td> ".$row['diffLevel']."</td>";
echo "<td> ".$row['grpSize']."</td>";
echo "<td> ".$row['distance']."</td>";
echo "<td> ".$row['tripLength']."</td>";
echo "<td> ".$row['createdAt']."</td>";
echo "<td> ".$row['modifiedAt']."</td>";
echo "<td> ".$row['pic']."</td></tr>";
}
echo "</table>";
//<input type="int" name="rating"><br>
?>
 <form action="" method="post" >
reviewText:<br>
  <input type="text" name="reviewText"><br>
rating:<br>
  1<input type="radio" id="1" name="rating" value="1">
  <br>
  2<input type="radio" id="2" name="rating" value="2">
  <br>
  3<input type="radio" id="3" name="rating" value="3">
  <br>
  4<input type="radio" id="4" name="rating" value="4">
  <br>
  5<input type="radio" id="5" name="rating" value="5">
  <br>
  <input type="submit" value="Submit" name="Submit">
</form>
<?php
if(isset($_POST['Submit'])){ 

    $reviewText=$_POST['reviewText'];
    $rating=$_POST['rating'];
$sql="INSERT INTO reviews(GID,userID,reviewText,rating) VALUES ((SELECT GID FROM groups WHERE GID='$id'),
(SELECT userID FROM Users WHERE userID='$userID'),'$reviewText','$rating')";
    $result=mysqli_query($conn,$sql) or die($conn->error);
    $sql1="SELECT AVG(rating) FROM reviews WHERE GID='$id'"; 
    $result=mysqli_query($conn,$sql1) or die($conn->error);
    $row= implode($result->fetch_array(MYSQLI_ASSOC));
    $sql2="UPDATE groups SET avgrating='$row' WHERE  GID='$id'";
    $result=mysqli_query($conn,$sql2) or die($conn->error);

}
?>
 

