<?php 
session_start();
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="../styles/previewStyles.css" rel="stylesheet" type="text/css">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <title>Sightscape</title>

    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
<body style='background-color: rgba(11, 29, 38,1)'>
<?php
  function checkLogin(){
    if(!isset($_SESSION['ID']) && !isset($_SESSION['userRole'])){
    ?>
    <nav class="navbar navbar-expand-md fixed-top navbar-dark background">
          <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../home/home.php"><h6>HOME</h6></a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../viewGroups/grouphikers.php"><h6>GROUP</h6></a>
                </li>
            </ul>
          </div>
          <div class="mx-auto order-0">
          <a class="navbar-brand" href="../home/home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
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
                      <a class="nav-link active" aria-current="page" href="../home/home.php"><h6>HOME</h6></a>
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
                  <a class="navbar-brand" href="../home/home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
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
                      <a class="nav-link active" aria-current="page" href="../home/home.php"><h6>HOME</h6></a>
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
                  <a class="navbar-brand" href="../home/home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
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
                      <a class="nav-link active" aria-current="page" href="../home/home.php"><h6>HOME</h6></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="../chat/newChat.php"><h6>CHAT</h6></a>
                  </li>
                    </ul>
                  </div>
                  <div class="mx-auto order-0">
                  <a class="navbar-brand" href="../home/home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
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
                      <a class="nav-link active" aria-current="page" href="../home/home.php"><h6>HOME</h6></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href=""><h6>CHAT REPORTS</h6></a>
                  </li>
                    </ul>
                  </div>
                  <div class="mx-auto order-0">
                  <a class="navbar-brand" href="../home/home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
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
  $hn='localhost';
  $db='project';
  $un='root';
  $pw='';
  $userID = 0;
  $id=$_GET['GID'];
  if(isset($_SESSION['ID']))
    $userID=$_SESSION['ID'];
  //require_once 'login.php'; //gets php code from another file
  $conn=new mysqli("localhost","$un","$pw","$db") or die ("fatal error cannot connect to DB");
  $sql = "SELECT * FROM groups WHERE GID = $id";
  //preperation for query
  $result=$conn->query($sql) or die ("fatal error in executing code");
  if($row= $result->fetch_array(MYSQLI_ASSOC)){
?>
<div class="mainContainer" style = "background: url('../controlgroups/images/<?php echo $row['pic']; ?>') no-repeat; background-size: 100%;">
<div class="darkerArea">
  <h1><?php echo strtoupper($row['loc']);?></h1>
  <form method='POST'>
    <button type = 'submit' name = 'cartButton' class = 'cartButton'>ADD TO CART</button>
  </form>
  
  <?php
if(isset($_POST['cartButton'])){
   header("Location: groupAddToCart.php?groups=$id");
}

?>
  <p>Scroll down for more information</p>
  
  <div class = container-Display>
    <div class = container-child>
    <i class="fas fa-hiking"></i>
      <h5>DISTANCE</h5> <h6><?php echo $row['distance'];?></h6>
    </div>
    <div class = container-child>
    <i class="fas fa-calendar-day"></i>
    <?php
      $dep = strtotime($row['departureTime']);
      $arr = strtotime($row['arrivalTime']);
      $dateDiff = $arr - $dep;
    ?>
      <h5>Trip Length</h5> <h6><?php echo (empty($row['tripLength']))? round($dateDiff / (60 * 60 * 24)) : $row['tripLength'];?> DAYS</h6><a href = '#dates'>Know more about the dates</a>
    </div>
    <div class = container-child>
    <i class="fas fa-running"></i>
      <h5>DIFFICULTY LEVEL</h5> <h6>LEVEL <?php echo $row['diffLevel'];?></h6>
      <a href='#diff'>Know more about difficulty levels</a>
    </div>
    </div>
    
</div>
</div>
<div class="midContainer">
  <h1 class = 'midHeader'>Get Ready For The Adventure</h1>
  <hr>
  <img src="../controlgroups/images/<?php echo $row['pic'];?>" style="float: right; margin-right: 100px;"  width="500" height="500">
  <p><?php echo $row['descrip']; ?></p>
  <h1 id = 'dates' class = 'midHeader'>Mark Up The Dates</h1>
  <hr>
  <div class="container-Display2">
    <?php
      $dep = strtotime($row['departureTime']);
      $arr = strtotime($row['arrivalTime']);
      $dep = date('j/m/Y', $dep);
      $arr = date('j/m/Y', $arr);
      ?>
      <div class="container-child2">
        
        <h1 class = 'dateHeader'><i class="fas fa-plane-departure"></i><br>Departure Date<br><span class = 'dateClass'><?php echo $dep; ?></span></h1>
      </div>
      <div class="container-child2">
        
        <h1 class = 'dateHeader'><i class="fas fa-plane-arrival"></i><br>Arrival Date<br><span class = 'dateClass'><?php echo $arr; ?></span></h1>
      </div>
  </div>
  <br>
  <h1 id = 'diff' class = 'midHeader'>Difficulty Level Identicator</h1>
  <hr>
  <div class="diffClass">
    <p>This hiking group have a difficulty level of <span style="color:goldenrod;"><strong><?php $row['diffLevel'] ?></strong></span>. 
    We identify each level according to the adminstrator of the group. 
    The adminstrator grades the trip accordingly.
    The levels are from 1 to 5:<ol><li>Easy</li><li>Rookie</li><li>Intermediate</li><li>Have some experiences</li><li>Proffessional</li></ol> 
   </p>
  </div>
  <h1 class="midHeader">Reviews And Rating</h1>
  <hr>
  <div class="reviewContainer">
    <h1><?php echo $row['avgrating'];?><span class="smallrating">stars</span></h1>
    <script>
      $(document).ready(function(){
        // Check Radio-box
        $(".rating input:radio").attr("checked", false);

        $('.rating input').click(function () {
          <?php if($userID != 0){ ?>
            $(".rating span").removeClass('checked');
            $(this).parent().addClass('checked');
            <?php }?>
        });

        $('input:radio').change(
          function(){
            var userRating = this.value;
            $.ajax({
              method: 'POST',
              url: 'groupRatingBackEnd.php',
              data:{
                'rating' : userRating,
                'GID' : <?php echo $id; ?>
              },
              success: (res) => {
                if(res == 'error'){
                  alert('You have to sign in to add a rating')
                  location.reload()
                }
                else
                // alert('You have to sign in to add a rating')
                  location.reload()
              }
            })
        }); 
      });
  </script>
  <h4>Rate the group</h4>
    <div class="rating">
        <span><input type="radio" name="rating" id="str5" value="5"><label for="str5"><span class="fa fa-star checkStar"></span></label></span>
        <span><input type="radio" name="rating" id="str4" value="4"><label for="str4"><span class="fa fa-star checkStar"></span></label></span>
        <span><input type="radio" name="rating" id="str3" value="3"><label for="str3"><span class="fa fa-star checkStar"></span></label></span>
        <span><input type="radio" name="rating" id="str2" value="2"><label for="str2"><span class="fa fa-star checkStar"></span></label></span>
        <span><input type="radio" name="rating" id="str1" value="1"><label for="str1"><span class="fa fa-star checkStar"></span></label></span>
    </div>
    <br><br><br>
    <h4>Give the group a review</h4>
    <!-- <form method="post" action=""> -->
      <input id = 'reviewText' name = "reviewText">
      <button id = 'submit'>review</button>
    <!-- </form> -->
    <script>
      $('#submit').click(function() {
        reviewText = $('#reviewText').val();
        gid = <?php echo $id ?>;
        userID = <?php echo $userID ?>;
        $.ajax({
          method: 'POST',
          url: 'groupReview.php',
          data: {
            'reviewText': reviewText,
            'gid': gid,
            'userID': userID
          },
          success: (result) => {
            $('#reviews').prepend('<h4>'+result+'</h4>')
            $('#reviewText').val('')
          }
        })
      })
    </script>
  <br>  <br><br>
    <h4>Reviews</h4>
    <div id="reviews">
    <?php
      $sql = "SELECT * FROM reviews WHERE GID = $id ORDER BY createdAt DESC";
      $result = $conn->query($sql);
      while($row3= $result->fetch_assoc()){
        if(!empty($row3['reviewText'])){
          $sql2 = "SELECT * FROM users WHERE userID = {$row3['userID']}";
          $result2 = $conn->query($sql2);
          if($row = $result2->fetch_assoc()){
            echo "<h4><div style='background-color: #173c4e; margin-right: 100px; padding: 10px;'><img src = '../users/images/{$row['pic']}' width = 100 height = 100>&nbsp{$row['fname']} {$row['lname']}<br>{$row3['reviewText']}</div><br><br></h4>";
          }
        }
      }

    ?>
    </div>
  </div>
</div>
<?php
}
?>


 

