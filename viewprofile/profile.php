<!-- <?php 
// session_start();
// include_once '../errorHandler/errorHandlers.php';
// set_error_handler('loginError',E_ALL);
// ?>
<html>
<body>
<table border =1>
<tr> <th> firstname </th> <th> lastname </th>  <th> Email </th> <th> picture </th> </tr>

<?php
// $hn='localhost';
// $db='project';
// $un='root';
// $pw='';

// $id=$_SESSION["ID"];
// //require_once 'login.php'; //gets php code from another file
// $conn=new mysqli("localhost","$un","$pw","$db") or die ("fatal error cannot connect to DB");

// $sql = "SELECT * FROM users WHERE userID = $id";
//  //preperation for query
// $result=$conn->query($sql) or die ("fatal error in executing code");
// if($row= $result->fetch_array(MYSQLI_ASSOC)){
// echo "<tr> <td> ".$row['fname']."</td>";
// echo "<td>  ".$row['lname']."</td>";
// echo "<td> ".$row['email']."</td>";
// echo "<td>  ".$row['pic']."</td>";
// echo "</tr>";
// }
?>
</table>
<form action ='Editinfo.php' method ='post'>
 <button type="submit"> Edit </button>
</body>
</html> -->

<?php 
session_start();
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <title>Sightscape</title>

    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
<body style = 'background-color: #0b1d26'>

<link rel="stylesheet" type= "text/css" href="../../project/styles/profile.css">
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
                    <a class="nav-link active" aria-current="page" href="../home.php"><h6>HOME</h6></a>
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
                    <a class="nav-link active" aria-current="page" href="../home.php"><h6>HOME</h6></a>
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
                    <a class="nav-link active" aria-current="page" href="../home.php"><h6>HOME</h6></a>
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
$hn='localhost';
$db='project';
$un='root';
$pw='';
?>
  <div class = 'TopContainer'></div>
<?php
//echo"<lable for='note'><b>First name</b></lable>";
//echo "<span class = 'note'>".$row['fname']."</span>";
$id=$_SESSION["ID"];
//require_once 'login.php'; //gets php code from another file
$conn=new mysqli("localhost","$un","$pw","$db") or die ("fatal error cannot connect to DB");


 //preperation for query


  $dir = "/project/users/images/";
        $profilePic = $_SESSION['profilepic'];
        $pic=$dir.$profilePic;
  echo "<img src='$pic' width='250' height='250' class = 'roundedProfilePicture' alt = '$pic'>";

  $sql = "SELECT * FROM users WHERE userID = $id";
  $result=$conn->query($sql) or die ("fatal error in executing code");
if($row= $result->fetch_array(MYSQLI_ASSOC)){
 //  <span class="square"> </span> <span class="note"> $row['fname'] </span>"
 //echo "<span class='square'>";
 //echo "<p><strong style = 'font-size: 15px;'>FIRST NAME &nbsp &nbsp &nbsp</strong><span class =
//  'note'>".$row['fname']."</span></p>";
//echo "<span class = 'note1'>".$row['lname']."</span>";
//echo "<span class = 'note2'>".$row['email']."</span>";
//echo "<span class = 'note3'>".$row['pic']."</span>";
//echo "</span>";

// <div class="logo-part">
// <img src="bckgrnd/logo.png" class="w-75 logo-footer" >
// </div>
//<div class = 'note2'><img src='images/".$_SESSION['pic'].'>"
//<img src="images/shahdpic.png" width="300" height="300" class="note2">
// <?php echo "<span class = 'note2'>".$row['pic']."</span>";
?>
<div class='squareA'>
  <h1> PERSONAL INFORMATION</h1>
  <hr>
  <br><br><br><br>
  <form action ='Editinfo.php' method ='post'>
    <button type="submit" class="button" name="Submit" id="Submit"> <i class="fas fa-edit"></i> EDIT </button>
    <script> document.getElementById('Submit').addEventListener('click',x);
    function x(){
      var u=document.getElementById('info');
      u.style.visibility='hidden';
    }
    </script>

    
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
    </script>
    </div>
  
</div>
<?php
}
?>
    

    
<!-- <div id='z' >
<div class="note" id="z"><p> First Name </p></div>
    <?php echo "<span class = 'note'id='z'>".$row['fname']."</span>";?>
    <div class="note1"><p> Last Name </p></div>
    <?php echo "<span class = 'note1'>".$row['lname']."</span>";?>
    <div class="note3"><p> Email </p>  </div>
    <?php echo "<span class = 'note3'>".$row['email']."</span>";?>
</div>

<form action ='Editinfopt2.php' method ='post'>
<div class="x"><p>Password and Authentication</p></div>
 <button type="submit" class="button3"> change password </button>
 <button type="submit" class="button4"> Delete My Account </button>
 <button type="submit" class="button5">change photo </button>
</form> -->
<footer class="container-fluid bg-grey py-5">
            <div class="container ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="logo-part">
                                <img src="/project/bckgrnd/logo.png" class="w-75 logo-footer" >
                            </div>
                            </div>
                            <div class="col-md-6 px-4">
                            <h6> About Company</h6>
                            <p>A website that connects all hikers in one place. We are here to give all hikers opportunity to view various hiking groups to different locations.</p>
                            <p>Our goal is to provide a service that organize hiking trips to all hikers on earth.</p>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <h6> Newsletter</h6>
                            <div class="social">
                                <a href="https://facebook.com"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="https://instagram.com"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="https://twitter.com"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="https://youtube.com"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                            </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </footer>
</body>
</html>