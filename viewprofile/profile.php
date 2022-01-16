<!-- <?php 
// session_start();
// include_once '../errorHandler/errorHandlers.php';
// set_error_handler('loginError',E_ALL);
// ?>
<html>
<body>
<table border =1>
<tr> <th> firstname </th> <th> lastname </th>  <th> Email </th> <th> picture </th> </tr>

<?php
// $hn='localhost';
// $db='project';
// $un='root';
// $pw='';

// $id=$_SESSION["ID"];
// //require_once 'login.php'; //gets php code from another file
// $conn=new mysqli("localhost","$un","$pw","$db") or die ("fatal error cannot connect to DB");

// $sql = "SELECT * FROM users WHERE userID = $id";
//  //preperation for query
// $result=$conn->query($sql) or die ("fatal error in executing code");
// if($row= $result->fetch_array(MYSQLI_ASSOC)){
// echo "<tr> <td> ".$row['fname']."</td>";
// echo "<td>  ".$row['lname']."</td>";
// echo "<td> ".$row['email']."</td>";
// echo "<td>  ".$row['pic']."</td>";
// echo "</tr>";
// }
?>
</table>
<form action ='Editinfo.php' method ='post'>
 <button type="submit"> Edit </button>
</body>
</html> -->

<?php 
session_start();
?>
<html>
    
<body>

<link rel="stylesheet" type= "text/css" href="../../project/styles/profile.css">
<?php
$hn='localhost';
$db='project';
$un='root';
$pw='';
//echo"<lable for='note'><b>First name</b></lable>";
//echo "<span class = 'note'>".$row['fname']."</span>";
$id=$_SESSION["ID"];
//require_once 'login.php'; //gets php code from another file
$conn=new mysqli("localhost","$un","$pw","$db") or die ("fatal error cannot connect to DB");

$sql = "SELECT * FROM users WHERE userID = $id";
 //preperation for query
$result=$conn->query($sql) or die ("fatal error in executing code");
if($row= $result->fetch_array(MYSQLI_ASSOC)){
 //  <span class="square"> </span> <span class="note"> $row['fname'] </span>"
 //echo "<span class='square'>";
 //echo "<p><strong style = 'font-size: 15px;'>FIRST NAME &nbsp &nbsp &nbsp</strong><span class =
//  'note'>".$row['fname']."</span></p>";
//echo "<span class = 'note1'>".$row['lname']."</span>";
//echo "<span class = 'note2'>".$row['email']."</span>";
//echo "<span class = 'note3'>".$row['pic']."</span>";
//echo "</span>";

// <div class="logo-part">
// <img src="bckgrnd/logo.png" class="w-75 logo-footer" >
// </div>
//<div class = 'note2'><img src='images/".$_SESSION['pic'].'>"
//<img src="images/shahdpic.png" width="300" height="300" class="note2">
// <?php echo "<span class = 'note2'>".$row['pic']."</span>";
}

  $dir = "/project/users/images/";
        $profilePic = $_SESSION['profilepic'];
        $pic=$dir.'/'.$profilePic;
  echo "<img src='$pic' width='250' height='250' class='note2'>";

?>
    
<div class='squareB'> </div>
<div class='squareA'></div>
<div class='squareC'></div>
<div id='z' >
<div class="note" id="z"><p> First Name </p></div>
    <?php echo "<span class = 'note'id='z'>".$row['fname']."</span>";?>
    <div class="note1"><p> Last Name </p></div>
    <?php echo "<span class = 'note1'>".$row['lname']."</span>";?>
    <div class="note3"><p> Email </p>  </div>
    <?php echo "<span class = 'note3'>".$row['email']."</span>";?>
</div>
<form action ='Editinfo.php' method ='post'>
 <button type="submit" class="button" name="Submit" id="Submit"> Edit </button>
<script> document.getElementById('Submit').addEventListener('click',x);
function x(){
   var u=document.getElementById('z');
   u.style.visibility='hidden';
}
</script>

 
</form>
<form action ='Editinfopt2.php' method ='post'>
<div class="x"><p>Password and Authentication</p></div>
 <button type="submit" class="button3"> change password </button>
 <button type="submit" class="button4"> Delete My Account </button>
 <button type="submit" class="button5">change photo </button>
</form>
</body>
</html>