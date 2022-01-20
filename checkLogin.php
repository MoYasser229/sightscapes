<?php
function checkLogin(){
              if(!isset($_SESSION['ID']) && !isset($_SESSION['userRole'])){
                ?>
             
              <nav class="navbar navbar-expand-md fixed-top navbar-dark background">
          <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
              <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../project/home.php"><h6>HOME</h6></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="../project/viewGroups/grouphikers.php"><h6>GROUP</h6></a>
                      </li>
              </ul>
          </div>
          <div class="mx-auto order-0">
          <a class="navbar-brand" href="#"><img src="../project/bckgrnd/logo.png" width="100px" height="100px"></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                  <span class="navbar-toggler-icon"></span>
              </button>
          </div>
          <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
              <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                        <a class="nav-link" href="../project/users/Login.php"><h6>LOGIN</h6></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="../project/users/Signup.php"><h6>SIGN UP</h6></a>
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
                                  <a class="nav-link active" aria-current="page" href="../project/home.php"><h6>HOME</h6></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="../project/admincontrol/admin.php"><h6>DATA MANAGEMENT</h6></a>
                                </li>
                              </ul>
                          </div>
                          <div class="mx-auto order-0">
                          <a class="navbar-brand" href="#"><img src="../project/bckgrnd/logo.png" width="100px" height="100px"></a>
                              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                                  <span class="navbar-toggler-icon"></span>
                              </button>
                          </div>
                          <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                              <ul class="navbar-nav ml-auto">
                              <li class="nav-item">
                              <a class="nav-link" href="../project/chat/chatMenu.php"><h6>CHAT</h6></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="../project/users/signOut.php"><h6>SIGN OUT</h6></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="../project/viewprofile/profile.php"><h6>PROFILE</h6></a>
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
                                  <a class="nav-link active" aria-current="page" href="../project/home.php"><h6>HOME</h6></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="../project/viewgroups/grouphikers.php"><h6>GROUPS</h6></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="../project/cart/cart.php"><h6>CART</h6></a>
                                </li>
                              </ul>
                          </div>
                          <div class="mx-auto order-0">
                          <a class="navbar-brand" href="#"><img src="../project/bckgrnd/logo.png" width="100px" height="100px"></a>
                              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                                  <span class="navbar-toggler-icon"></span>
                              </button>
                          </div>
                          <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                              <ul class="navbar-nav ml-auto">
                              <li class="nav-item">
                              <a class="nav-link" href="../project/chat/chatMenu.php"><h6>CHAT</h6></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="../project/users/signOut.php"><h6>SIGN OUT</h6></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="../project/viewprofile/profile.php"><h6>PROFILE</h6></a>
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
                                  <a class="nav-link active" aria-current="page" href="../project/home.php"><h6>HOME</h6></a>
                                </li>
                                <li class="nav-item">
                              <a class="nav-link" href="../project/chat/chatMenu.php"><h6>CHAT</h6></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="../project/survey/survey.php"><h6>SURVEY</h6></a>
                            </li>
                              </ul>
                          </div>
                          <div class="mx-auto order-0">
                          <a class="navbar-brand" href="#"><img src="../project/bckgrnd/logo.png" width="100px" height="100px"></a>
                              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                                  <span class="navbar-toggler-icon"></span>
                              </button>
                          </div>
                          <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                              <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                              <a class="nav-link" href="../project/users/signOut.php"><h6>SIGN OUT</h6></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="../project/viewprofile/profile.php"><h6>PROFILE</h6></a>
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
                                  <a class="nav-link active" aria-current="page" href="../project/home.php"><h6>HOME</h6></a>
                                </li>
                                <li class="nav-item">
                              <a class="nav-link" href="../project/chat/chatMenu.php"><h6>CHAT REPORTS</h6></a>
                            </li>
                              </ul>
                          </div>
                          <div class="mx-auto order-0">
                          <a class="navbar-brand" href="#"><img src="../project/bckgrnd/logo.png" width="100px" height="100px"></a>
                              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                                  <span class="navbar-toggler-icon"></span>
                              </button>
                          </div>
                          <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                              <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                              <a class="nav-link" href="../project/users/signOut.php"><h6>SIGN OUT</h6></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="../project/viewprofile/profile.php"><h6>PROFILE</h6></a>
                            </li>
                              </ul>
                          </div>
                      </nav>
                      <?php
                    }
      }