<?php 
session_start();
include_once '../errorHandler/errorHandlers.php';
set_error_handler('loginError',E_ALL);
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <title>Sightscapes</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
<body style = 'background-color: #0b1d26'>

<link rel="stylesheet" type= "text/css" href="../styles/profile.css">
<style>
  .background{
    background-color: #0b1d26;
    height: 75px;
  }
</style>
<?php
include_once "../users/checkLogin.php"; 
checkLogin();
$hn='localhost';
$db='project';
$un='root';
$pw='';
?>
  <div class = 'TopContainer'></div>
  <?php
$id=$_SESSION["ID"];
$conn=new mysqli("localhost","$un","$pw","$db") or die ("fatal error cannot connect to DB");

  $dir = "../users/images/";
        $profilePic = $_SESSION['profilepic'];
        $pic=$dir.$profilePic;
  echo "<img src='$pic' width='250' height='250' class = 'roundedProfilePicture' alt = '$pic'>";

  $sql = "SELECT * FROM users WHERE userID = $id";
  $result=$conn->query($sql) or die ("fatal error in executing code");
if($row= $result->fetch_array(MYSQLI_ASSOC)){
?>
<div class='squareA'>
  <h1> PERSONAL INFORMATION</h1>
  <hr>
  <br><br><br><br>
  <form action ='Editinfo.php' method ='post'>
    <button type="submit" class="button" name="Submit" id="Submit"> <i class="fas fa-edit"></i> EDIT </button>
    

    
    </form>
    <div id="info">
      <table>
      <tr><td><h4>FIRST NAME</h4></td> <td><span class = 'textRight'><?php echo $row['fname'] ?></span></td></tr>
      <tr><td><h4>LAST NAME</h4></td> <td><span class = 'textRight'><?php echo $row['lname'] ?></span></td></tr>
      <tr><td><h4>EMAIL</h4></td><td><span class = 'textRight'><?php echo $row['email'] ?></span></td></tr>
      </table>
    </div>
    <div class="PasswordInfo">
      <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "project";
        $id=$_SESSION["ID"];
        $conn = new mysqli($servername, $username, $password, $dbname);
      ?>
      <h2>Update Credentials</h2><br>
      <script>
          var errorInPassword = false
      </script>
      <form action='' method='post' class='passwordForm'>
      <h5>Enter old Password</h5><input type= 'password'  name= 'oldPassword' placeholder= 'Old Password'><br><br>
      <h5>Enter new Password</h5><input type='password'  name='newPassword' placeholder= 'New Password'><br><br>
      <input type= 'submit'  name= 'submit' class='button1' value= 'SUBMIT' style='color: white' ><br>
      </form>
      <?php if($_SESSION['userRole'] == 'admin') { ?>
        <h2>Warnings</h2>
        <p class = 'textDelete'>
          <?php
            $userID = $_SESSION['ID'];
            $conn = new mysqli("localhost" , "root" , "" , "project");
            $sql = "SELECT * FROM WARNINGS WHERE userID = $userID";
            $result = $conn->query($sql);
            if(mysqli_num_rows($result) === 0){
              echo "You have no warnings";
            }
            while($row = $result->fetch_assoc()){
              $chatID = $row['chatID'];
              $senderName = '';
              $sql = "SELECT fname from users WHERE userID = (SELECT senderID FROM chat WHERE chatID = $chatID)";
              $result = $conn->query($sql);
              if($FnameRow = $result->fetch_assoc()){
                  $senderName = $FnameRow['fname'];
              }
              echo "PENALTY ADDED TO YOU FROM CHAT ID#$chatID <br>";
              echo "THE HIKER IN THE CHAT WAS $senderName";
              echo "<br>";
          }
          ?>
        </p>
      <?php } ?>
      <h2>Delete Your Account</h2>
      <p class = 'textDelete'>NOTE: Your account will be permanently deleted. You cant sign in with the account.</p>
      <button class="button4" onclick="confirmAction()"> Delete My Account </button>
      <?php 
        if(isset($_POST['submit'])){
            $oldPassword = $_POST['oldPassword'];
            $newPassword = $_POST['newPassword'];
            $oldPswrd = mysqli_real_escape_string($conn,$oldPassword);
            $oldPswrd = md5($oldPswrd);
            $sql = "SELECT * FROM users WHERE userID = $id AND pswrd = '$oldPswrd'";
            $result = $conn->query($sql);
            if($row = $result->fetch_assoc()){
                if(empty($_POST['oldPassword']) || empty($_POST['newPassword']))
                    echo "<script>errorInPassword = true</script>";
                else{
                    $password=mysqli_real_escape_string($conn,$_POST['newPassword']);
                    $password = md5($password);
                    $sql="UPDATE users set pswrd='$password' where userID = '$id'";
                    $result=mysqli_query($conn,$sql) or die("Unable to execute query");
                    $_SESSION["Password"] = $password;
                    echo "<script>alert('Password Changed Successfully');</script>";
                }
            }
            else{
                echo "<script>alert('Please enter the correct old password')</script>";
            }

        }
    ?>
    
    <script>
        if(errorInPassword === true)
            alert("Password is not given")

            function confirmAction() {
              let confirmAction = confirm("Are you sure to execute this action?");
              if (confirmAction) {
                alert("Action successfully executed");
                location.href = 'deleteAcc.php'; 
              } else {
                alert("Action canceled");
              }
            }
    </script>
    </div>
  
</div>
<?php
}
?>