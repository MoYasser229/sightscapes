<?php session_start();
include_once '../errorHandler/errorHandlers.php';
set_error_handler('customError',E_ALL); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <title>Sightscapes</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
<body style="background-color: #0b1d26">
	<style>
		.background{
			background-color: #0b1d26;
			height: 75px;
		}
	</style>
<?php
include_once "../users/checkLogin.php"; 
checkLogin();
?>

<script>
	var errorInFirstName = false
	var errorInLastName = false
	var errorInEmail = false
	var errorEmailMistype = false
	var errorEmailUsed = false
	var errorInPicture = false
</script>
<link rel="stylesheet" type= "text/css" href="../../project/styles/EditInfo.css">
<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$id=$_SESSION["ID"];
 $conn = new mysqli($servername, $username, $password, $dbname);
 ?>
 <div class="midContainer">
	 <h1> EDIT YOUR PERSONAL INFORMATION</h1>
	 <form class = 'editForm' action='' method='post' enctype = 'multipart/form-data'>
	<h5>First Name: </h5><input type= 'text'class='note1'  name= 'firstname'  value="<?php echo $_SESSION['FName'];?>"><br><br>
	<h5>Last Name: </h5><input type= 'text' class='note2' name= 'lastname' value="<?php echo $_SESSION['LName'];?>"><br><br>
	<h5>Email: </h5><input type= 'text' class='note3' name= 'email'   value="<?php echo $_SESSION['Email'];?>"><br><br>
	<h5>Picture: </h5><input type= 'file'  name= 'picEdit'  value="<?php echo $_SESSION['profilepic']?>"><br>
	<h5>Remove Picture: <input type= 'checkbox'  name= 'picRemove'  value='remove'></h5><br>
	<input type= 'submit' class='button1' name= 'submit'  value= 'Submit' ><br>
	</form>
 </div>

 <?php
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
			$dir = "../users/images/";
			$profilePic = $_SESSION['profilepic'];
			
			if(!empty($_FILES['picEdit']['name'])){
				
				$profilePic = $_FILES['picEdit']['name'];
				move_uploaded_file($_FILES['picEdit']['tmp_name'], $dir.$profilePic);
			}
			else{
				$profilePic = (isset($_POST['picRemove']))?'default.png':$_SESSION['profilepic'];
			}
			$fname=$_POST['firstname'];
			$lname=$_POST['lastname'];
			$email=$_POST['email'];
			$r= false;
			$sql="UPDATE users set fname= '$fname', lname= '$lname', email= '$email' ,pic= '$profilePic' where userID = '$id'";
			$result= mysqli_query($conn,$sql) or die($conn->error);
			$_SESSION["FName"]=$fname;
			$_SESSION["LName"]=$lname;
			$_SESSION["Email"]=$email;
			$_SESSION["profilepic"]=$profilePic;
			header("Location:profile.php");
		}
	}
?>
<script>
	var errors = ""
	if(errorInFirstName === true)
		errors += "First Name is not given"
	if(errorInLastName === true)
		errors += "Last Name is not given"
	if(errorInEmail === true)
		errors += "Email is not given"
	if(errorEmailMistype === true)
		errors += "Email is invalid"
	if(errorEmailUsed === true)
		errors += "Email is already used"
	if(errors != "")
		alert(errors)
</script>

</body>
</html>
