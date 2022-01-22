<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="../styles/homestyles.css" rel="stylesheet" type="text/css">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <title>Sightscape</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body style="background-color: #0b1d26">
    <?php
            //START UP PHP CODE//
      include_once "../createdb.php";//Database code
      session_start();
      include_once "../users/checkLogin.php";//Navigation Bar Function Implementation
      checkLogin();
    ?>

        <!-- Introduction Part -->
        <div class = "sky-bck">
            <div class="top-header">
                <h1>Let The Journey Begin</h1>
                <p>ADVENTURE AWAITS</p>
                <hr>
                <button class = "button-style"><i class="fa fa-long-arrow-down" aria-hidden="true"></i>  &nbsp SCROLL DOWN</button>
            </div>
            <div class = "mountain-bck">
                <div class = "ground-bck"></div>
            </div>
        </div>
        
        
        <!-- Mid Part -->
        <section class="section" style="margin-right: 10%;">
            <div class="content" style="margin-right: 10%;">
                <h1>Experience New <h1>Level of Adventures</h1></h1>
                <hr>
                <p> You can find various hiking groups each with a different adventure. 
                    Hiking groups are updated and organized for you to choose the prefered group. 
                    Not interested in any of the groups available? 
                    You can suggest a group and one of our admins will review 
                    your request and add the hiker group.</p>
            </div>
            <img src="../bckgrnd/m2.jpg" class="image" width="500" height="500"/>
        </section>

        <section class="section">
            <img src="../bckgrnd/m3.jpg" class="image" width="500" height="500"/>
            <div class="content" style="margin-left: 10%;">
                <h1>Experience New <h1>Level of Adventures</h1></h1>
                <hr>
                <p> You can find various hiking groups each with a different adventure.
                     Hiking groups are updated and organized for you to choose the prefered group. 
                     Not interested in any of the groups available? 
                     You can suggest a group and one of our admins will 
                     review your request and add the hiker group.</p>
            </div>
        </section>
        <section class="section" style="margin-right: 10%;">
            <div class="content2" style="margin-right: 10%;">
                <h1>Experience New <h1>Level of Adventures</h1></h1>
                <hr>
                <p> You can find various hiking groups each with a different adventure. 
                    Hiking groups are updated and organized for you to choose the prefered group.
                    Not interested in any of the groups available? 
                    You can suggest a group and one of our admins will 
                    review your request and add the hiker group.</p>
            </div>
            <img src="../bckgrnd/m4.jpg" class="image" width="500" height="500"/>
        </section>
        <footer class="container-fluid bg-grey py-5">
            <div class="container ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="logo-part">
                                <img src="../bckgrnd/logo.png" class="w-75 logo-footer" >
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
                                <a href="https://facebook.com"><i class="fa fa-facebook"></i></a>
                                <a href="https://instagram.com"><i class="fa fa-instagram"></i></a>
                                <a href="https://twitter.com"><i class="fa fa-twitter"></i></a>
                                <a href="https://youtube.com"><i class="fa fa-youtube"></i></a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
        </footer>
        
</body>
</html>
