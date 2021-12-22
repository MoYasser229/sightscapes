



<?php 
//include "menu.php";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectF";
session_start();

// Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);

	echo "<form action='' method='get'>";
	echo "Name: <input type= 'text'  name= 'Name'  value=".$_SESSION['Name']."><br>";
	echo "Email: <input type= 'text'  name= 'Email' value=".$_SESSION['Email']."><br>";
	echo "<input type= 'submit'  name= 'submit'  value= 'Submit' ><br>";
	echo"</form>";
//check if form is submitted and update the values
	$_SESSION['ID']=4;
if(isset($_GET['submit'])){
$sql="update  trial1 set 
Name='".$_GET['Name']."',
Email='".$_GET['Email']."'
where ID='".$_SESSION['ID']."'
";
$result=mysqli_query($conn,$sql);//check if query is executed sucessfully
if(!$result){

	echo $conn->error;
	die("Unable to execute query");
}
else{
	$_SESSION["Name"]=$_GET["Name"];
	$_SESSION["Email"]=$_GET["Email"];
	echo "<h3 style='color:green;'>Updated </h3>";
     //header ('projecthome.php');
}
}

?>
