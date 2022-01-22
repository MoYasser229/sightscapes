<?php session_start(); ?>
<script>
    var errorInEmail = false
    var used = false
</script>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Sign Up</title>
        </head>
    <body style = "background-image: url('../bckgrnd/signup.jpg'); background-size: cover;">
		<?php include_once "../users/checkLogin.php"; checkLogin(); ?>
		<link href="../styles/loginstyles.css" rel="stylesheet" type="text/css">
        <div class = "login" style='width:30%;height: 65%;top: 21%;'>
            <br><h5 style='cursor:default;'>Welcome to Sightscapes!</h5>
            <br>
            <form action="" method="post"  enctype = 'multipart/form-data'>
              <div class="form-row">
            <div class="col">
            First Name <input type="text" name="fname" class="form-control" required>
          </div><div class="col-auto">
            Last Name <input type="text" name="lname" class="form-control" required>
          </div>
          </div>
          <div class="form-row">
          <div class="col">
            Email <input type="text" name="Email" class="form-control" required>
          </div><div class="col">
            Password <input type="Password" name="Password" class="form-control" required>
          </div>
          </div>
           <br>Profile Picture <input type="file" name="picture" class="form-control" ><br>
            Sign up as <select name="role" class="form-control" required>
            <option value="hiker">Hiker</option>
            <option value="hr">HR</option>
            <option value="admin">Admin</option>
            <option value="auditor">Auditor</option>
          </select><br>
  			<button class="btn btn-primary buttonclass" type="submit" name="Submit">Create your account</button>
		</form>
        </div>
     </body>
</html>
<?php
$conn = new mysqli("localhost", "root", "", "project");

$emailError="";
$error = false;
if(isset($_POST['Submit'])){ 
  $profilePic = 'default.png';
    $fname=$_POST['fname'];
    $lname = $_POST['lname']; 
    $email=$_POST['Email'];
    $password=mysqli_real_escape_string($conn,$_POST['Password']);
    $password = md5($password);
    $role = $_POST['role'];
  $sql="SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql)  or die($conn->error);
        if($row = $result->fetch_assoc()){
          echo "<script>used = true</script>"; $error = true;
        }
  if(!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL))
    {echo "<script>errorInEmail = true</script>"; $error = true;}
  if($error === false){
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
      $password=mysqli_real_escape_string($conn,$_POST['Password']);
      $password = md5($password);
      $sql="SELECT * FROM users WHERE Email='".$_POST['Email']."'"." AND pswrd='".$password."'";
        $result = $conn->query($sql)  or die($conn->error);
        if($row = $result->fetch_assoc()){
            $_SESSION["ID"]=$row['userID'];
            $_SESSION["FName"]=$row["fname"];
            $_SESSION["LName"]=$row["lname"];
            $_SESSION["Email"]=$row["email"];
            $_SESSION["Password"]=$row["pswrd"];
            $_SESSION['userRole'] = $role;
            if(isset($row['pic']))
              $_SESSION['profilepic'] = $row['pic'];
            header("Location:../home/home.php");
        }
    }
    else die($conn->error);
  }
}
?>
<script>
  let form = ""
  if(errorInEmail === true)
      form += "Error: Email is mistyped or not given\n"
  if(used === true)
    form += "Error: Email is already used\n"
  if(form != "")
    alert(form)
</script>