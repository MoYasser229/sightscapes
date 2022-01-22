<!-- <?php 
include_once '../errorHandler/errorHandlers.php';
//  set_error_handler('customError',E_ALL);

?>
<script>
	var errorInFirstName = false
	var errorInLastName = false
	var errorInEmail = false
	var errorEmailMistype = false
	var errorEmailUsed = false
	var errorInPicture = false
</script>
<?php 
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "project";
// session_start();
// $id=$_SESSION["ID"];
// // Create connection
//  $conn = new mysqli($servername, $username, $password, $dbname);

// 	echo "<form action='' method='POST' enctype = 'multipart/form-data'>";
// 	echo "firstname: <input type= 'text'  name= 'firstname'  value=".$_SESSION['FName']."><br>";
// 	echo "lastname: <input type= 'text'  name= 'lastname' value=".$_SESSION['LName']."><br>";
// 	echo "email: <input type= 'text'  name= 'email'  value=".$_SESSION['Email']."><br>";
// 	echo "picture: <input type= 'file'  name= 'picEdit'><br>";
// 	echo "Remove Picture <input type= 'checkbox'  name= 'picRemove'  value='remove'><br>";
// 	echo "<input type= 'submit'  name= 'submitUpdate'  value= 'Submit' ><br>";
// 	echo"</form>";
	
// //check if form is submitted and UPDATE the values
// 	$error = false;
// 	if(isset($_POST['submitUpdate'])){
		
// 		if(empty($_POST['firstname'])){
// 			echo "<script>errorInFirstName = true</script>";
// 			$error = true;
// 		}
// 		if(empty($_POST['lastname'])){
// 			echo "<script>errorInLastName = true</script>";
// 			$error = true;
// 		}
// 		if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
// 			echo "<script>errorEmailMistype = true</script>";
// 			$error = true;
// 		}
// 		if(empty($_POST['email'])){
// 			echo "<script>errorInEmail = true</script>";
// 			$error = true;
// 		}
// 		else{
// 			$email=$_POST['email'];
// 			$id = $_SESSION['ID'];
// 			$sql = "SELECT * from users where email = '$email' AND userID != '$id'";
// 			$result = $conn->query($sql) or die($conn->error);
// 			if($row = $result->fetch_assoc()){
// 				echo "<script>errorEmailUsed = true</script>";
// 				$error = true;
// 			}
// 		}
// 		if($error === false){
// 			$dir = "../users/images/";
// 			$profilePic = $_SESSION['profilepic'];
			
// 			if(!empty($_FILES['picEdit']['name'])){
				
// 				$profilePic = $_FILES['picEdit']['name'];
// 				move_uploaded_file($_FILES['picEdit']['tmp_name'], $dir.$profilePic);
// 			}
// 			else{
// 				$profilePic = ($_POST['picRemove'] === 'remove')?'default.png':$_SESSION['profilepic'];
				
// 			}
			
// 			$fname=$_POST['firstname'];
// 			$lname=$_POST['lastname'];
// 			$email=$_POST['email'];
// 			$r= false;
// 			$sql="UPDATE users set fname= '$fname', lname= '$lname', email= '$email' ,pic= '$profilePic' where userID = '$id'";
// 			$result= mysqli_query($conn,$sql) or die($conn->error);
// 			$_SESSION["FName"]=$fname;
// 			$_SESSION["LName"]=$lname;
// 			$_SESSION["Email"]=$email;
// 			$_SESSION["profilepic"]=$profilePic;
// 			header("Location:EditInfo.php");
// 		}
// 	}
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
</script> -->
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <title>Sightscape</title>

    <!-- Bootstrap CSS -->
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
function checkLogin(){
	if ($_SESSION['userRole'] === "admin"){
	  ?>
			  <nav class="navbar navbar-expand-md fixed-top navbar-dark background">
		  <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
			  <ul class="navbar-nav mr-auto">
				  <li class="nav-item">
				  <a class="nav-link active" aria-current="page" href="../home/home.php"><h6>HOME</h6></a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="../admincontrol/admin.php"><h6>DATA MANAGEMENT</h6></a>
				</li>
			  </ul>
		  </div>
		  <div class="mx-auto order-0">
		  <a class="navbar-brand" href="#"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
				  <span class="navbar-toggler-icon"></span>
			  </button>
		  </div>
		  <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
			  <ul class="navbar-nav ml-auto">
			  <li class="nav-item">
			  <a class="nav-link" href="../chat/chatMenu.php"><h6>CHAT</h6></a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="../users/signOut.php"><h6>SIGN OUT</h6></a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="../viewprofile/profile.php"><h6>PROFILE</h6></a>
			</li>
			  </ul>
		  </div>
	  </nav>
	  <?php
	}
	else if($_SESSION['userRole'] === 'hiker'){
	  ?>
		<nav class="navbar navbar-expand-md fixed-top navbar-dark background">
		  <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
			  <ul class="navbar-nav mr-auto">
				  <li class="nav-item">
				  <a class="nav-link active" aria-current="page" href="../home/home.php"><h6>HOME</h6></a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="../viewgroups/grouphikers.php"><h6>GROUPS</h6></a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="../cart/cart.php"><h6>CART</h6></a>
				</li>
			  </ul>
		  </div>
		  <div class="mx-auto order-0">
		  <a class="navbar-brand" href="#"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
				  <span class="navbar-toggler-icon"></span>
			  </button>
		  </div>
		  <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
			  <ul class="navbar-nav ml-auto">
			  <li class="nav-item">
			  <a class="nav-link" href="../chat/chatMenu.php"><h6>CHAT</h6></a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="../users/signOut.php"><h6>SIGN OUT</h6></a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="../viewprofile/profile.php"><h6>PROFILE</h6></a>
			</li>
			  </ul>
		  </div>
	  </nav>
	  <?php
	}
	else if($_SESSION['userRole'] === "auditor"){
	  ?>
		<nav class="navbar navbar-expand-md fixed-top navbar-dark background">
		  <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
			  <ul class="navbar-nav mr-auto">
				  <li class="nav-item">
				  <a class="nav-link active" aria-current="page" href="../home/home.php"><h6>HOME</h6></a>
				</li>
				<li class="nav-item">
			  <a class="nav-link" href="../chat/chatMenu.php"><h6>CHAT</h6></a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="../survey/survey.php"><h6>SURVEY</h6></a>
			</li>
			  </ul>
		  </div>
		  <div class="mx-auto order-0">
		  <a class="navbar-brand" href="#"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
				  <span class="navbar-toggler-icon"></span>
			  </button>
		  </div>
		  <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
			  <ul class="navbar-nav ml-auto">
			<li class="nav-item">
			  <a class="nav-link" href="../users/signOut.php"><h6>SIGN OUT</h6></a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="../viewprofile/profile.php"><h6>PROFILE</h6></a>
			</li>
			  </ul>
		  </div>
	  </nav>
	  <?php
	}
	else if($_SESSION['userRole'] == 'hr'){
	  ?>
		<nav class="navbar navbar-expand-md fixed-top navbar-dark background">
		  <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
			  <ul class="navbar-nav mr-auto">
				  <li class="nav-item">
				  <a class="nav-link active" aria-current="page" href="../home/home.php"><h6>HOME</h6></a>
				</li>
				<li class="nav-item">
			  <a class="nav-link" href="../chat/chatMenu.php"><h6>CHAT REPORTS</h6></a>
			</li>
			  </ul>
		  </div>
		  <div class="mx-auto order-0">
		  <a class="navbar-brand" href="#"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
				  <span class="navbar-toggler-icon"></span>
			  </button>
		  </div>
		  <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
			  <ul class="navbar-nav ml-auto">
			<li class="nav-item">
			  <a class="nav-link" href="../users/signOut.php"><h6>SIGN OUT</h6></a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="../viewprofile/profile.php"><h6>PROFILE</h6></a>
			</li>
			  </ul>
		  </div>
	  </nav>
	  <?php
	}
}
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
<!-- <div class='background'>
</div> -->
<!-- <div class='square'> </div>
<div class="note4"><p> First Name : </p></div>
<div class="note5"><p> Last Name : </p></div>
<div class="note6"><p>Email : </p></div> -->
<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$id=$_SESSION["ID"];

// Create connection
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
	// echo "<form class = 'editForm' action='' method='post' enctype = 'multipart/form-data'>";
	// echo " <input type= 'text'class='note1'  name= 'firstname'  value=".$_SESSION['FName']."><br>";
	// echo " <input type= 'text' class='note2' name= 'lastname' value=".$_SESSION['LName']."><br>";
	// echo " <input type= 'text' class='note3' name= 'email'   value=".$_SESSION['Email']."><br>";
	//echo "picture: <input type= 'file'  name= 'picEdit'  value=".$_SESSION['profilepic']."><br>";
	//echo "Remove Picture <input type= 'checkbox'  name= 'picRemove'  value='remove'><br>";
	// echo "<input type= 'submit' class='button1' name= 'submit'  value= 'Submit' ><br>";
	// echo"</form>";
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
