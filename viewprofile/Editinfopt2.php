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
	echo "password: <input type= 'text'  name= 'password'  value=".$_SESSION['password']."><br>";
	echo "Mobile: <input type= 'text'  name= 'Mobile' value=".$_SESSION['Mobile']."><br>";
	echo "<input type= 'submit'  name= 'submit'  value= 'Submit' ><br>";
	echo"</form>";
//check if form is submitted and update the values
	$_SESSION['ID']=4;
if(isset($_GET['submit'])){
$sql="update  trial1 set 
password='".$_GET['password']."',
Mobile='".$_GET['Mobile']."'
where ID='".$_SESSION['ID']."'
";
$result=mysqli_query($conn,$sql);//check if query is executed sucessfully
if(!$result){

	echo $conn->error;
	die("Unable to execute query");
}
else{
	$_SESSION["password"]=$_GET["password"];
	$_SESSION["Mobile"]=$_GET["Mobile"];
	echo "<h3 style='color:green;'>Updated </h3>";
     //header ('projecthome.php');
}
}

?>
