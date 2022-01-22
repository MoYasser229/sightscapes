<?php 
session_start();
 ?>

<script>
    var errorInCorrect = false
    var errorInEmail = false
</script>

<html>
    <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Log In</title>
  </head>
    <body style = "background-image: url('../bckgrnd/login.jpg'); background-size: cover;">
        <?php include_once "../users/checkLogin.php"; checkLogin(); ?>
        <link href="../styles/loginstyles.css" rel="stylesheet" type="text/css">
        <div class = "login">
            <br><h5>Welcome to Sightscapes!</h5>
            <br>
            <form action="" method="post">
            <div class="form-row">
                Email <input type="text"  name="Email" class="form-control" required><br>
                Password <input type="password" name="Password" class="form-control" required><br>
              </div><br>
              <button class="btn btn-primary buttonclass" type="submit" name="Submit">Log in</button>
            <br>  <p>Not a member yet? <a class="linkclass" href='Signup.php'>Register now!</a></p>
        </form>

            
        </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
<?php
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
            header("Location: ../home/home.php");
        }
        else{
            echo "<script>errorInCorrect = true</script>";
        }
    }
else if (isset($_POST['Submit']) && !filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)){
    echo "<script>errorInEmail = true</script>";
}
?>
<script>
                let form = ""
                if(errorInCorrect === true && errorInEmail === false) {
                    form += "Error: email or password is incorrect\n"
                }
                if(errorInEmail === true)
                    form += "Error: Email is mistyped or not given\n"
                    if(form != "")
                        alert(form)
            </script>