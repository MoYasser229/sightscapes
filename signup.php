<!doctype html>
<html lang="en">

<script>
    var errorInEmail = false
    var used = false
    var errorInPassword = false
    var errorInFname = false
    var errorInLname = false
</script>
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">


</head>

<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$emailError="";
$error = false;
if(isset($_POST['Submit'])){ 
  $profilePic = 'default.png';
    $fname=$_POST['fname'];
    $lname = $_POST['lname']; 
    $email=$_POST['Email'];
    $password=$_POST['Password'];
    $role = $_POST['role'];
  $sql="SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql)  or die($conn->error);
        if($row = $result->fetch_assoc()){
          echo "<script>used = true</script>"; $error = true;
        }
  if(empty($_POST['Email']) || !filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL))
    {echo "<script>errorInEmail = true</script>"; $error = true;}
  if(empty($_POST['Password']))
    {echo "<script>errorInPassword = true</script>"; $error = true;}
  if(empty($_POST['fname']))
    {echo "<script>errorInFname = true</script>"; $error = true;}
  if(empty($_POST['lname']))
    {echo "<script>errorInLname = true</script>"; $error = true;}
  if($error === false){
    // $sql = "SELECT * FROM hikers "
    $dir = "images/";
    
    if(!empty($_FILES['picture']['name'])){
    $profilePic = $_FILES['picture']['name'];
    move_uploaded_file($_FILES['picture']['tmp_name'], $dir.$profilePic);
    }
    else
    $profilePic = 'default.png';
    
    $sql="INSERT INTO users (fname,lname,email,pswrd,pic,userRole) VALUES('$fname','$lname','$email','$password','$profilePic','$role')";
    $queryResult=mysqli_query($conn,$sql);
    if($queryResult) 
    {
      echo $_POST['role'];
      $sql="SELECT * FROM users WHERE Email='".$_POST['Email']."'"." AND pswrd='".$_POST['Password']."'";
        $result = $conn->query($sql)  or die($conn->error);
        if($row = $result->fetch_assoc()){
            $_SESSION["ID"]=$row[0];
            $_SESSION["FName"]=$row["fname"];
            $_SESSION["LName"]=$row["lname"];
            $_SESSION["Email"]=$row["email"];
            $_SESSION["Password"]=$row["pswrd"];
            $_SESSION['userRole'] = $role;
            if(isset($row['pic']))
              $_SESSION['profilepic'] = $row['pic'];
            header("Location:../home.php");
        }
    }
    else
    {
    die($conn->error);
    }
    }
}
?>
<style>
*{
	padding:0;
	margin:0;
	font-family: sans-serif;
}
body{
	background-color:rgb(240,240,240);
	
	
}
.container{
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction:column;
	background-color: #ffffff;
	width: 40%;
	min-width:500px;
	position: relative;
	padding: 100px 20px;
	border-radius: 7px;
	box-shadow:0 9px 20px rgba(2,2,2,0.11)
	user-select:none;
}
input[type="file"]{
	display: none;
}
labelw{
	position: aboslute;
	bottom: 5rem;
	background-color: #ff4765;
	color: #ffffff
	font-size: 20px;
	text-align: center;
	width: 15rem;
	padding: 20px 0;
	border-radius: 10rem;
	cursor: pointer;
	border: solid 6px #ffa0b0;
}
label:active{
	transform: scale(.9);
}
.container p{
	font-size: 18px;
	font-weight: 500;
	color: rgb(112,112,112);
	text-align: center;
	position: relative;
	top: 4rem;
	user-select: none;
}
#images{
	position: relative;
	bottom: 5rem;
	display: flex;
	flex-wrap: wrap;
	justify-content: space-evenly;
}
figure{
	width: 30%;
}
img{
	width:100%
}
ficaption{
	text-align: center;
	font-size:12px;
	color: rgb(90,88,88);
	margin-top: 8px;
}
</style>
<script>
let fileInput= document.getElementById("file-input");
let imageContainer= document.getElementById("images");
let numberOfImage= document.getElementById("number-of-img");
function preview(){
imageContainer.innerHTML="";
numberOfImage.textContent='${fileInput.files.length} Files Selected';
numberOfImage.style.color="black";

for(i of fileInput.files){
	let reader= new FileReader();
	let figure= document.createElement("figure");
	let figCap= document.createElement("figcaption");
	figCap.innerText= i.name;
	figure.appendChild(figCap);
	reader.onload=()=>{
		let img= document.createElement("img");
		img.setAttribute("src",reader.result);
		figure.insertBefore(img.figCap);
	}
	imageContainer.appendChild(figure);
	reader.readAsDataURL(i);
}
}




</script>
<h1>Sign Up</h1>
<form action="" method="post" enctype = 'multipart/form-data'>
 <div class="form-group mb-3">
<label class="label" for="name">Sign Up AS: </label> 
<select name="role">
  <option value="hiker">Hiker</option>
  <option value="hr">HR</option>
  <option value="admin">Admin</option>
  <option value="auditor">Auditor</option>
</select><br>
</div>

<script>
  let form = ""
                if(errorInEmail === true)
                    form += "Error: Email is mistyped or not given\n"
                if(errorInPassword === true)
                    form += "Error: Password is not given\n"
                if(errorInFname === true)
                    form += "Error: First Name is not given\n"
                if(errorInLname === true)
                    form += "Error: Last Name is not given\n"
                    if(used === true)
                    form += "Error: Email is already used\n"
                    if(form != "")
                        alert(form)
</script>
<body>

	<form action="" method=" post" enctype='multipart/form-data' class="signin-form">
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">First Name</label>
			      			<input type="text" name="fname" class="form-control" placeholder="ex:John" required>
			      		</div>
						<div class="form-group mb-3">
			      			<label class="label" for="name">Last Name</label>
			      			<input type="text" name="lname" class="form-control" placeholder="ex:Doe" required>
			      		</div>
						<div class="form-group mb-3">
			      			<label class="label" for="name"> Email</label>
			      			<input type="text" name=" Email" class="form-control" placeholder="example@gmail.com" required><?php echo $emailError; ?>
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" class="form-control" placeholder="Password" required>
		            </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary rounded submit px-3">submit </button>
		            </div>
		           <div class="container"> 
				   <div id="images"></div>
				   <input type ="file" id= "file-input" accept= "image/png, image/jpg" onchange="preview()" multiple>
				   <button class="form-control btn btn-primary rounded submit px-3" id="button" form="file-input">
				     <i class="fas fa-upload"></i> Upload profile picture
					 </label>
					 <p id= "numer-of-img"> No image selected! </p>
					 </div>
					 
					
		          </form>
				  </body>
