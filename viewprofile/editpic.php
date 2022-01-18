<script>
	var errorInFirstName = false
	var errorInLastName = false
	var errorInEmail = false
	var errorEmailMistype = false
	var errorEmailUsed = false
	var errorInPicture = false
</script>
<link rel="stylesheet" type= "text/css" href="../../project/styles/editpic.css">
<div class='background'>
</div>
<div class='square'> </div>
<div class="note2"><p> picture : </p></div>
<div class="note3"><p> Remove picture </p></div> 
<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
session_start();
$id=$_SESSION["ID"];

// Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);

	echo "<form action='' method='post' enctype = 'multipart/form-data'>";
	// echo " <input type= 'text'class='note1'  name= 'firstname'  value=".$_SESSION['FName']."><br>";
	// echo " <input type= 'text' class='note2' name= 'lastname' value=".$_SESSION['LName']."><br>";
	// echo " <input type= 'text' class='note3' name= 'email'   value=".$_SESSION['Email']."><br>";
	echo " <input type= 'file'  name= 'pic' class='note1'  value=".$_SESSION['profilepic']."><br>";
	echo " <input type= 'checkbox'  name= 'picRemove' class='note4'  value='remove'><br>";
	echo "<input type= 'submit'  name= 'submit' class='button1' value= 'Submit' ><br>";
	echo"</form>";
//check if form is submitted and UPDATE the values
	$error = false;
	if(isset($_POST['submit'])){
		if(empty($_POST['firstname'])){
			echo "<script>errorInFirstName = true</script>";
			$error = true;
		}
		if(empty($_POST['lastname'])){
			echo "<script>errorInLastName = true</script>";
			$error = true;
		}
		if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
			echo "<script>errorEmailMistype = true</script>";
			$error = true;
		}
		if(empty($_POST['email'])){
			echo "<script>errorInEmail = true</script>";
			$error = true;
		}
		else{
			$email=$_POST['email'];
			$id = $_SESSION['ID'];
			$sql = "SELECT * from users where email = '$email' AND userID != '$id'";
			$result = $conn->query($sql) or die($conn->error);
			if($row = $result->fetch_assoc()){
				echo "<script>errorEmailUsed = true</script>";
				$error = true;
			}
		}
		
		if($error === false){
			
			$dir = "images/";
			$profilePic = $_SESSION['profilepic'];
			if(!empty($_FILES['pic']['name'])){
				$profilePic = $_FILES['pic']['name'];
				move_uploaded_file($_FILES['pic']['tmp_name'], $dir.$profilePic);
			}
			else
				$profilePic = ($_POST['picRemove'] === 'remove')?'default.png':$_SESSION['profilepic'];
			
			//$fname=$_POST['firstname'];
		//	$lname=$_POST['lastname'];
			//$email=$_POST['email'];
			$r= false;
			$sql="UPDATE users set pic= '$profilePic' where userID = '$id'";
			$result= mysqli_query($conn,$sql) or die($conn->error);
			//$_SESSION["FName"]=$fname;
			//$_SESSION["LName"]=$lname;
			//$_SESSION["Email"]=$email;
			$_SESSION["profilepic"]=$pic;
			header("Location:EditInfo.php");
		}
	}
?>

