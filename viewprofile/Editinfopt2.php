<?php 
session_start();
//include_once '../errorHandler/errorHandlers.php';
//set_error_handler('loginError',E_ALL);
?>
<script>
    var errorInPassword = false
</script>
<link rel="stylesheet" type= "text/css" href="../../project/styles/EditInfopt2.css">
<div class='background'>
</div>
<div class='square'> </div>
<div class="note2"><p> Enter old Password: </p></div>
<div class="note3"><p> Enter new Password: </p></div>
<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$id=$_SESSION["ID"];


// Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
    echo "<form action='' method='post'>";
    echo " <input type= 'password'class='oldpass'  name= 'oldPassword'><br>";
    echo " <input type='password' class='note4'  name='newPassword'>";
    echo "<input type= 'submit'  name= 'submit' class='button1' value= 'Submit' ><br>";
    echo"</form>";
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
                header("Location:EditInfopt2.php");
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