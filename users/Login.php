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
    $password=mysqli_real_escape_string($conn,$_POST['Password']);
    $password = md5($password);
$sql="SELECT * FROM users WHERE email='".$_POST['Email']."'"." AND pswrd='$password'";
$result = mysqli_query($conn,$sql) or die($conn->error); 
        if($row=$result->fetch_assoc()) 
        {
            $_SESSION["ID"]=$row['userID'];
            $_SESSION["FName"]=$row["fname"];
            $_SESSION["LName"]=$row["lname"];
            $_SESSION["Email"]=$row["email"];
            $_SESSION["Password"]=$row["pswrd"];
            $_SESSION['userRole'] = $row["userRole"];
            if(isset($row['pic']))
                $_SESSION['profilepic'] = $row['pic'];
                header("Location: ../../project/home.php");
        }
        else{
            echo "<script>errorInCorrect = true</script>";
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>LOGIN</title>
        <link href="/project/styles/loginstyles.css" rel = "stylesheet" type="text/css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body style = "background-color: #0b1d26;">
    <?php
        function checkLogin(){
			if(!isset($_SESSION['ID']) && !isset($_SESSION['userRole'])){
			?>
			<nav class="navbar navbar-expand-md fixed-top navbar-dark bck">
						<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
							<ul class="navbar-nav mr-auto">
							<li class="nav-item">
									<a class="nav-link active" aria-current="page" href="../home.php"><h6>HOME</h6></a>
									</li>
									<li class="nav-item">
									<a class="nav-link" href="../viewGroups/grouphikers.php"><h6>GROUP</h6></a>
									</li>
							</ul>
						</div>
						<div class="mx-auto order-0">
						<a class="navbar-brand" href="../home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
								<span class="navbar-toggler-icon"></span>
							</button>
						</div>
						<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
							<ul class="navbar-nav ml-auto">
							<li class="nav-item">
									<a class="nav-link" href="../users/Login.php"><h6>LOGIN</h6></a>
									</li>
									<li class="nav-item">
									<a class="nav-link" href="../users/Signup.php"><h6>SIGN UP</h6></a>
									</li>
							</ul>
						</div>
						</nav>
								<?php
								}
								else if ($_SESSION['userRole'] === "admin"){
									?>
											<nav class="navbar navbar-expand-md fixed-top navbar-dark background">
										<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
											<ul class="navbar-nav mr-auto">
												<li class="nav-item">
												<a class="nav-link active" aria-current="page" href="../home.php"><h6>HOME</h6></a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="../admincontrol/admin.php"><h6>DATA MANAGEMENT</h6></a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="orders/orders.php"><h6>ORDERS</h6></a>
											</li>
											</ul>
										</div>
										<div class="mx-auto order-0">
										<a class="navbar-brand" href="../home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
											<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
												<span class="navbar-toggler-icon"></span>
											</button>
										</div>
										<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
											<ul class="navbar-nav ml-auto">
											<li class="nav-item">
											<a class="nav-link" href="../chat/newChat.php"><h6>CHAT</h6></a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="../users/signOut.php"><h6>SIGN OUT</h6></a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="../viewprofile/projecthome.php"><h6>PROFILE</h6></a>
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
												<a class="nav-link active" aria-current="page" href="../home.php"><h6>HOME</h6></a>
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
										<a class="navbar-brand" href="../home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
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
											<a class="nav-link" href="../viewprofile/projecthome.php"><h6>PROFILE</h6></a>
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
												<a class="nav-link active" aria-current="page" href="../home.php"><h6>HOME</h6></a>
											</li>
											<li class="nav-item">
											<a class="nav-link" href="../chat/newChat.php"><h6>CHAT</h6></a>
										</li>
											</ul>
										</div>
										<div class="mx-auto order-0">
										<a class="navbar-brand" href="../home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
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
											<a class="nav-link" href="../viewprofile/projecthome.php"><h6>PROFILE</h6></a>
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
												<a class="nav-link active" aria-current="page" href="../home.php"><h6>HOME</h6></a>
											</li>
											<li class="nav-item">
											<a class="nav-link" href=""><h6>CHAT REPORTS</h6></a>
										</li>
											</ul>
										</div>
										<div class="mx-auto order-0">
										<a class="navbar-brand" href="../home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
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
											<a class="nav-link" href="../viewprofile/projecthome.php"><h6>PROFILE</h6></a>
										</li>
											</ul>
										</div>
									</nav>
									<?php
								}
			}
		checkLogin();
    ?>
    <div class="top">
                
        <div class="background">
            <div class = "INFO">
                <p>Enter Your Login </p><p>Information</p>
            </div>
            </div>
        <div class = "login">
            <h1>LOGIN</h1>
            <br>
            <form action="" method="post">
                <p class = "inputText">EMAIL</p>
                <input class = "input" type="text" name="Email" placeholder="example@example.com">  <br><br>
                <p class = "inputText">PASSWORD</p>
                <input id = "password" class = "input" type="Password" name="Password" placeholder = "example: someone123" ><br><br>
                <input id = "btn" class = 'submit' type="submit" value="LOGIN" name="Submit" >
                <input class = 'submit' type="reset" value="RESET">
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
