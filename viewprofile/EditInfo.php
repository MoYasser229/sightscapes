<script>
	var errorInFirstName = false
	var errorInLastName = false
	var errorInEmail = false
	var errorEmailMistype = false
	var errorEmailUsed = false
	var errorInPicture = false
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

	echo "<form action='' method='post' enctype = 'multipart/form-data'>";
	echo "firstname: <input type= 'text'  name= 'firstname'  value=".$_SESSION['FName']."><br>";
	echo "lastname: <input type= 'text'  name= 'lastname' value=".$_SESSION['LName']."><br>";
	echo "email: <input type= 'text'  name= 'email'  value=".$_SESSION['Email']."><br>";
	echo "picture: <input type= 'file'  name= 'pic'  value=".$_SESSION['profilepic']."><br>";
	echo "Remove Picture <input type= 'checkbox'  name= 'picRemove'  value='remove'><br>";
	echo "<input type= 'submit'  name= 'submit'  value= 'Submit' ><br>";
	echo"</form>";
//check if form is submitted and UPDATE the values
	//$_SESSION['ID']=4;
	//role
	$role = $_SESSION["Role"];
	//role id hikerID-adminID
	$roleid = substr($role,0,strlen($role)-1) . "ID";
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
			$sql = "SELECT * from $role where email = '$email' AND $roleid != '$id'";
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
			
			$fname=$_POST['firstname'];
			$lname=$_POST['lastname'];
			$email=$_POST['email'];
			$r= false;
			$sql="UPDATE $role set fname= '$fname', lname= '$lname', email= '$email' ,pic= '$profilePic' where $roleid = '$id'";
			$result= mysqli_query($conn,$sql) or die($conn->error);
			$_SESSION["FName"]=$fname;
			$_SESSION["LName"]=$lname;
			$_SESSION["Email"]=$email;
			$_SESSION["profilepic"]=$pic;
			header("Location:EditInfo.php");
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
