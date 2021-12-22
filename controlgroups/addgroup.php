<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectF";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$emailError="";

if(isset($_POST['Submit'])){ //check if form was submitted
  if(empty($_POST['Email']))
  {
    $emailError="Email is required";
  }
  else
  {
    
    $name=$_POST['Name'];
    $email=$_POST['Email'];
    $password=$_POST['Password'];
    $Mobile=$_POST['Mobile'];
     $ID=$_POST['ID'];
    $sql="INSERT INTO trial1(Name,Email,Password,Mobile,ID)
    VALUES ('$name','$email','$password','$Mobile',$ID)";
    $result=mysqli_query($conn,$sql);
    if($result) 
    {
      //header("Location:home.php");
    }
    else
    {
      echo $sql;
    }
  }
}
?>

<?php //include "menu.php";?>

<h1>Add</h1>
<form action="" method="post">
  Name:<br>
  <input type="text" name="Name"><br> 
  Email:<br>
  <input type="text" name="Email">  <?php echo $emailError; ?><br>
Mobile:<br>
  <input type="text" name="Mobile"><br>
  ID:<br>
  <input type="text" name="ID"><br>
  Password:<br>
  <input type="Password" name="Password"><br>
  <input type="submit" value="Submit" name="Submit">
  <input type="reset">
</form>