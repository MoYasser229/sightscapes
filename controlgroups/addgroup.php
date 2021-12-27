<script>
    var errorInPrice = false
    var errorInLocation = false
    var errorInDeparture = false
    var errorInArrival = false
    var errorInDescription = false
    var errorInPicture = false
</script>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$error = false;
if(isset($_POST['Submit'])){ //check if form was submitted
    $price=$_POST['price'];
    $Loc=$_POST['Loc'];
    $departureTime=$_POST['departureTime'];
    $arrivalTime=$_POST['arrivalTime'];
    $descrip=$_POST['descrip'];
    

    if(empty($price)){
      echo "<script>errorInPrice = true</script>";
      $error = true;
    }
    if(empty($Loc)){
      echo "<script>errorInLocation = true</script>";
      $error = true;
    }
    if(empty($departureTime)){
      echo "<script>errorInDeparture = true</script>";
      $error = true;
    }
    if(empty($arrivalTime)){
      echo "<script>errorInArrival = true</script>";
      $error = true;
    }
    if(empty($descrip)){
      echo "<script>errorInDescription = true</script>";
      $error = true;
    }
    $pic = "";
    $dir = "images/";
    if(!empty($_FILES['picture']['name'])){
        $pic = $_FILES['picture']['name'];
        move_uploaded_file($_FILES['picture']['tmp_name'], $dir.$pic);
    }
    else{
      echo "<script>errorInPicture = true;</script>";
      $error = true;
    }
    
    if($error === false){
    $sql="INSERT INTO groups(price,Loc,departureTime,arrivalTime,descrip,pic)
    VALUES ('$price',' $Loc','$departureTime','$arrivalTime','$descrip','$pic')";
    $result=mysqli_query($conn,$sql);
    header("Location: /project/controlgroups/groupadminview.php");
  }
  }

?>


<h1>Add</h1>
<form action="" method="post" enctype="multipart/form-data">
  Price:<br>
  <input type="text" name="price"><br> 
  Location:<br>
  <input type="text" name="Loc"><br> 
  Departure Time:<br>
  <input type="DATE" name="departureTime"><br>
  Arrival Time:<br>
  <input type="DATE" name="arrivalTime"><br>
  Description:<br>
  <input type="text" name="descrip"><br>
  Picture:<br>
  <input type="file" name="picture"><br><br>
  <input type="submit" value="Submit" name="Submit">
  <input type="reset">
</form>
<script>
error = ""
if(errorInLocation === true)
error += "Error: Location is not given"
if(errorInDeparture === true)
error += "Error: Departure Time is not given"
if(errorInArrival === true)
error += "Error: Arrival Time is not given"
if(errorInDescription === true)
error += "Error: Description is not given"
if(errorInPicture === true)
error+= "Error: Picture is not given"
if(errorInPrice === true)
error+= "Error: Price is not given"
if(error != "")
alert(error)
</script>