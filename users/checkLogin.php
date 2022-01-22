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
              <a class="nav-link" href="../viewGroups/grouphikers.php"><h6>GROUPS</h6></a>
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
        <a class="nav-link" href="../viewprofile/profile.php"><h6>PROFILE</h6></a>
      </li>
        </ul>
      </div>
    </nav>
    <?php
  }
  else if($_SESSION['userRole'] === 'hiker'){
    $id=$_SESSION['ID'];
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
        <?php
        $conn=new mysqli("localhost","root","","project") or die ("cannot connect to the database");
        $sql="SELECT * FROM survey";
        $rs=$conn->query($sql);
        while($row=$rs->fetch_assoc()){
          if($row['startDate']<=date("Y-m-d")&&$row['endDate'] >= date("Y-m-d")){
            $surveyid=$row['surveyID'];
            $query="UPDATE survey SET isOpen='1' WHERE surveyID='$surveyid'";
            $result=$conn->query($query) or die("Error: ".$conn->error);
          }
          else {
            $surveyid=$row['surveyID'];
            $query="UPDATE survey SET isOpen='0' WHERE surveyID='$surveyid'";
            $result=$conn->query($query) or die("Error: ".$conn->error);
          }
        }
        $surveys=[];
        $sql1="SELECT * FROM survey WHERE surveyType='Satisfaction Survey'";
        $rs1=$conn->query($sql1);
        while($row1=$rs1->fetch_assoc()){
          if($row1['isOpen']==1){
            array_push($surveys,$row1['surveyID']);
          }
        }
        $sql2="SELECT s.isOpen,s.surveyID FROM survey as s,orders as o WHERE s.surveyType='Post-Trip Survey' AND o.userID='$id' AND s.GroupSpecified=o.GID";
        $rs2=$conn->query($sql2);
        while($row2=$rs2->fetch_assoc()){
          if($row2['isOpen']==1){
            array_push($surveys,$row2['surveyID']);
          }
        }
        if($surveys){
          echo "<li class='nav-item'>
            <a class='nav-link' href='../survey/survey.php?surveys=".serialize($surveys)."'><h6>SURVEY</h6></a>
          </li>";
        }
      ?>
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
          <a class="nav-link active" aria-current="page" href="../home/home.php"><h6>HOME</h6></a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="../chat/chatMenu.php"><h6>CHAT</h6></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../survey/surveyauditor.php"><h6>SURVEY</h6></a>
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
        <a class="nav-link" href="../viewprofile/profile.php"><h6>PROFILE</h6></a>
      </li>
        </ul>
      </div>
    </nav>
    <?php
  }
}
?>