<script>
    var errorInEmail = false
    var used = false
    var errorInPassword = false
    var errorInFname = false
    var errorInLname = false
</script>
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
  $sql="SELECT * FROM hikers WHERE hikers.Email='$email'";
        $result = $conn->query($sql)  or die($conn->error);
        if($row = $result->fetch_assoc()){
          echo "<script>used = true</script>"; $error = true;
        }
        else{
          $sql="SELECT * FROM admins WHERE admins.Email='$email'";
        $result = $conn->query($sql)  or die($conn->error);
        if($row = $result->fetch_assoc()){
          echo "<script>used = true</script>"; $error = true;
        }
        else{
          $sql="SELECT * FROM auditors WHERE auditors.Email='$email'";
        $result = $conn->query($sql)  or die($conn->error);
        if($row = $result->fetch_assoc()){
          echo "<script>used = true</script>"; $error = true;
        }
        else{
          $sql="SELECT * FROM hrs WHERE hrs.Email='$email'";
        $result = $conn->query($sql)  or die($conn->error);
        if($row = $result->fetch_assoc()){
          echo "<script>used = true</script>"; $error = true;
        }
        }
        }
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
    
    $sql="INSERT INTO $role (fname,lname,email,pswrd,pic) VALUES('$fname','$lname','$email','$password','$profilePic')";
    $queryResult=mysqli_query($conn,$sql);
    if($queryResult) 
    {
      echo $_POST['role'];
      $sql="SELECT * FROM $role WHERE Email='".$_POST['Email']."'"." AND pswrd='".$_POST['Password']."'";
        $result = $conn->query($sql)  or die($conn->error);
        if($row = $result->fetch_assoc()){
            $_SESSION["ID"]=$row[0];
            $_SESSION["FName"]=$row["fname"];
            $_SESSION["LName"]=$row["lname"];
            $_SESSION["Email"]=$row["email"];
            $_SESSION["Password"]=$row["pswrd"];
            $_SESSION['Role'] = $role;
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

<h1>Sign Up</h1>
<form action="" method="post" enctype = 'multipart/form-data'>
  Sign up as:<br>
<select name="role">
  <option value="Hikers">Hiker</option>
  <option value="HRs">HR</option>
  <option value="Admins">Admin</option>
  <option value="Auditors">Auditor</option>
</select><br>
  First Name:<br>
  <input type="text" name="fname"><br> 
  Last Name:<br>
  <input type="text" name="lname"><br>
  Email:<br>
  <input type="text" name="Email">  <?php echo $emailError; ?><br>
  Password:<br>
  <input type="Password" name="Password"><br>
  Profile Picture:<br>
  <input type="file" name="picture"><br><br>
  <input type="submit" value="Submit" name="Submit">
  <input type="reset">
</form>
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

<!-- <html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>SIGN UP</title>
        <link href="/project/styles/signupstyles.css" rel = "stylesheet" type="text/css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
    <div class="top">
                
        <div class="background">
            <div class = "INFO">
                <p>Get </p><p>Started</p>
            </div>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/project/home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Groups</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="Login&Signup/Login.php">Log In<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="">Sign Up</a>
            </li>
            </ul>
        </div>
        </nav>
            </div>
        <div class = "login">
            <h1>SIGNUP</h1>
            <br>
            <form action="" method="post" enctype = 'multipart/form-data'>
              <p class = "inputText">FIRST NAME</p>
              <input class = "input" type="text" name="fname"><br><br>
              <p class = "inputText">LAST NAME</p>
              <input class = "input" type="text" name="lname"><br><br>
              <p class = "inputText">EMAIL</p>
              <input class = "input" type="text" name="Email">  <?php echo $emailError; ?><br><br>
              <p class = "inputText">PASSWORD</p>
              <input class = "input" type="Password" name="Password"><br><br>
              <p class = "inputText">PROFILE PICTURE</p>
              <!-- <input class = "fileinput" type="file" name="picture" class="inputFile"><br><br> -->
              <!-- <div class="mb-3">
              <label for="formFileSm" class="form-label">Small file input example</label>
              <input class="form-control form-control-sm" id="formFileSm" type="file" name="picture">
              </div> -->
              <!-- <div class="file-input">
                <input type="file" id="file" class="file">
                <label for="file">
                  Select file
                  <p class="file-name"></p>
                </label>
              </div>
              <input type="submit" value="Submit" name="Submit">
              <input type="reset">
            </form>
            <script>
              const file = document.querySelector('#file');
file.addEventListener('change', (e) => {
  // Get the selected file
  const [file] = e.target.files;
  // Get the file name and size
  const { name: fileName, size } = file;
  // Convert size in bytes to kilo bytes
  const fileSize = (size / 1000000).toFixed(2);
  // Set the text content
  const fileNameAndSize = `${fileName} - ${fileSize}MB`;
  document.querySelector('.file-name').textContent = fileNameAndSize;
});


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
</html> --> 
