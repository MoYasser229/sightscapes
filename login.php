<script>
    var errorInCorrect = false
    var errorInEmail = false
    var errorInPassword = false
</script>
<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);
if(isset($_POST['Submit']) && filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)){ //check if form was submitted
$sql="SELECT * FROM Hikers WHERE Email='".$_POST['Email']."'"." AND pswrd='".$_POST['Password']."'";
$result = mysqli_query($conn,$sql) or die($conn->error); 
if($row=$result->fetch_assoc()) 
{
    $_SESSION["ID"]=$row['hikerID'];
    $_SESSION["FName"]=$row["fname"];
    $_SESSION["LName"]=$row["lname"];
    $_SESSION["Email"]=$row["email"];
    $_SESSION["Password"]=$row["pswrd"];
    $_SESSION['Role'] = "Hikers";
    if(isset($row['pic']))
        $_SESSION['profilepic'] = $row['pic'];
        header("Location: ../../project/home.php");
}
else 
{
$sql="SELECT * FROM Admins WHERE Email='".$_POST['Email']."'"." AND pswrd='".$_POST['Password']."'";
$resultAdmins = mysqli_query($conn, $sql) or die($conn->error); 
if($row = $resultAdmins->fetch_assoc()){
    $_SESSION["ID"]=$row['adminID'];
    $_SESSION["FName"]=$row["fname"];
    $_SESSION["LName"]=$row["lname"];
    $_SESSION["Email"]=$row["email"];
    $_SESSION["Password"]=$row["pswrd"];
    $_SESSION['Role'] = "Admins";
    if(isset($row['pic']))
        $_SESSION['profilepic'] = $row['pic'];
    header("Location: ../../project/home.php");
}
else{
    $sql="SELECT * FROM Auditors WHERE Email='".$_POST['Email']."'"." AND pswrd='".$_POST['Password']."'";
    $resultAuditor = $conn->query($sql) or die($conn->error);
    if($row = $resultAuditor->fetch_assoc()){
        $_SESSION["ID"]=$row['auditorID'];
        $_SESSION["FName"]=$row["fname"];
        $_SESSION["LName"]=$row["lname"];
        $_SESSION["Email"]=$row["email"];
        $_SESSION["Password"]=$row["pswrd"];
        $_SESSION['Role'] = "Auditors";
        if(isset($row['pic']))
            $_SESSION['profilepic'] = $row['pic'];
        header("Location: ../../project/home.php");
    }
    else{
        $sql="SELECT * FROM HRs WHERE Email='".$_POST['Email']."'"." AND pswrd='".$_POST['Password']."'";
        $resultHRs = $conn->query($sql)  or die($conn->error);
        if($row = $resultHRs->fetch_assoc()){
            $_SESSION["ID"]=$row['hrID'];
            $_SESSION["FName"]=$row["fname"];
            $_SESSION["LName"]=$row["lname"];
            $_SESSION["Email"]=$row["email"];
            $_SESSION["Password"]=$row["pswrd"];
            $_SESSION['Role'] = "HRs";
            if(isset($row['pic']))
              $_SESSION['profilepic'] = $row['pic'];
            header("Location: ../../project/home.php");
        }
        else{
            echo "<script>errorInCorrect = true</script>";
        }
    }
}
}
}
else if (isset($_POST['Submit']) && !filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)){
    echo "<script>errorInEmail = true</script>";
}
if(isset($_POST['Submit']) && $_POST['Password'] === ""){
    echo "<script>errorInPassword = true</script>";
}
?>
<html>
    <head>
    <meta charset="utf-8">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">
	
	
   
        <title>LOGIN</title>
        <link href="/project/styles/loginstyles.css" rel = "stylesheet" type="text/css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
	<style>
	
	
	background-image:linear-gradient(to bottom, rgba(255,255,0,0.5), rgba(0,0,255,0.5));
</style>

	
	
    	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section"> </h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(images/bg.jpg);">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
								<div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
			      	</div>
	
  
        <div class = "login">
		<form action="" method="post">

			      		<div class="form-group mb-3">
						
							<label class="label" for="name">Email</label>
			      			<input type="text" class="form-control" name= "Email" placeholder="example@example.com" required>
			      		</div>
		            <div class="form-group mb-3">
						<label class="label" for="password">Password</label>
		              <input type="password" class="form-control" placeholder="Password" required>

		            </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	<label class="checkbox-wrap checkbox-primary mb-0">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
										</label>
									</div>
									<div class="w-50 text-md-right">
										<a href="send_link.php">Forgot Password</a>
									</div>
		            </div>
		          <p class="text-center">Not a member? <a data-toggle="tab" href= 'signup.php'>Sign Up</a></p>
		        </div>
		      </div>
				</div>
			</div>
			
            </form>
            <script>
                let form = ""
                if(errorInCorrect === true && errorInEmail === false && errorInPassword === false) {
                    form += "Error: email or password is incorrect\n"
                }
                if(errorInEmail === true)
                    form += "Error: Email is mistyped or not given\n"
                if(errorInPassword === true)
                    form += "Error: Password is not given"
                    if(form != "")
                        alert(form)
            </script>
        </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>