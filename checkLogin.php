<?php
function checkLogin(){
              if(!isset($_SESSION['ID']) && !isset($_SESSION['userRole'])){
                ?>
             
              <nav class="navbar navbar-expand-md fixed-top navbar-dark background">
          <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
              <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php"><h6>HOME</h6></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="viewGroups/grouphikers.php"><h6>GROUP</h6></a>
                      </li>
              </ul>
          </div>
          <div class="mx-auto order-0">
          <a class="navbar-brand" href="#"><img src="bckgrnd/logo.png" width="100px" height="100px"></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                  <span class="navbar-toggler-icon"></span>
              </button>
          </div>
          <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
              <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                        <a class="nav-link" href="users/Login.php"><h6>LOGIN</h6></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="users/Signup.php"><h6>SIGN UP</h6></a>
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
                                  <a class="nav-link active" aria-current="page" href="home.php"><h6>HOME</h6></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="admincontrol/admin.php"><h6>DATA MANAGEMENT</h6></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="orders/orders.php"><h6>ORDERS</h6></a>
                                </li>
                              </ul>
                          </div>
                          <div class="mx-auto order-0">
                          <a class="navbar-brand" href="#"><img src="bckgrnd/logo.png" width="100px" height="100px"></a>
                              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                                  <span class="navbar-toggler-icon"></span>
                              </button>
                          </div>
                          <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                              <ul class="navbar-nav ml-auto">
                              <li class="nav-item">
                              <a class="nav-link" href="chat/chatMenu.php"><h6>CHAT</h6></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="users/signOut.php"><h6>SIGN OUT</h6></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="viewprofile/projecthome.php"><h6>PROFILE</h6></a>
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
                                  <a class="nav-link active" aria-current="page" href="home.php"><h6>HOME</h6></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="viewgroups/grouphikers.php"><h6>GROUPS</h6></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="cart/cart.php"><h6>CART</h6></a>
                                </li>
                              </ul>
                          </div>
                          <div class="mx-auto order-0">
                          <a class="navbar-brand" href="#"><img src="bckgrnd/logo.png" width="100px" height="100px"></a>
                              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                                  <span class="navbar-toggler-icon"></span>
                              </button>
                          </div>
                          <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                              <ul class="navbar-nav ml-auto">
                              <li class="nav-item">
                              <a class="nav-link" href="chat/chatMenu.php"><h6>CHAT</h6></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="users/signOut.php"><h6>SIGN OUT</h6></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="viewprofile/projecthome.php"><h6>PROFILE</h6></a>
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
                                  <a class="nav-link active" aria-current="page" href="home.php"><h6>HOME</h6></a>
                                </li>
                                <li class="nav-item">
                              <a class="nav-link" href="chat/chatMenu.php"><h6>CHAT</h6></a>
                            </li>
                              </ul>
                          </div>
                          <div class="mx-auto order-0">
                          <a class="navbar-brand" href="#"><img src="bckgrnd/logo.png" width="100px" height="100px"></a>
                              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                                  <span class="navbar-toggler-icon"></span>
                              </button>
                          </div>
                          <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                              <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                              <a class="nav-link" href="users/signOut.php"><h6>SIGN OUT</h6></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="viewprofile/projecthome.php"><h6>PROFILE</h6></a>
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
                                  <a class="nav-link active" aria-current="page" href="home.php"><h6>HOME</h6></a>
                                </li>
                                <li class="nav-item">
                              <a class="nav-link" href="chat/chatMenu.php"><h6>CHAT REPORTS</h6></a>
                            </li>
                              </ul>
                          </div>
                          <div class="mx-auto order-0">
                          <a class="navbar-brand" href="#"><img src="bckgrnd/logo.png" width="100px" height="100px"></a>
                              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                                  <span class="navbar-toggler-icon"></span>
                              </button>
                          </div>
                          <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                              <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                              <a class="nav-link" href="users/signOut.php"><h6>SIGN OUT</h6></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="viewprofile/projecthome.php"><h6>PROFILE</h6></a>
                            </li>
                              </ul>
                          </div>
                      </nav>
                      <?php
                    }
      }