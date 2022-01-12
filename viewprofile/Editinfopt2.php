<script>
	var errorInPassword = false
</script>
<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
session_start();
$id=$_SESSION["ID"];


// Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
	echo "<form action='' method='post'>";
	echo "password: <input type= 'password'  name= 'Password'  value=".$_SESSION['Password']."><br>";
	echo "<input type= 'submit'  name= 'submit'  value= 'Submit' ><br>";
	echo"</form>";
	if(isset($_POST['submit'])){
		if(empty($_POST['Password']))
			echo "<script>errorInPassword = true</script>";
		else{
			$pswrd=$_POST['Password'];
			$sql="UPDATE users set pswrd='$pswrd' where userID = '$id'";
			$result=mysqli_query($conn,$sql) or die("Unable to execute query");
			$_SESSION["Password"] = $pswrd;
			header("Location:EditInfopt2.php");
		}
	}
?>
<script>
	if(errorInPassword === true)
		alert("Password is not given")
</script>