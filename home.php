<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="styles/homestyles.css" rel="stylesheet" type="text/css">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <title>Sightscape</title>

    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>

    <body style="background-color: #0b1d26">
    <?php
      include_once "createdb.php";
      session_start();
      include_once "checkLogin.php";
      checkLogin();
?>

    
        <div class = "sky-bck">
            <!-- <img src="bckgrnd/sky.png" srcset="bckgrnd/sky-p-500.png 500w, bckgrnd/sky-p-800.png 800w, bckgrnd/sky-p-1080.png 1080w, bckgrnd/sky.png 1920w" sizes="(max-width: 1920px) 50%, 1920px" alt="" class="sky"> -->
            <div class="top-header">
            <h1>Let The Journey Begin</h1>
            <p>ADVENTURE AWAITS</p>
            <hr>
            <button class = "button-style"><i class="fa fa-long-arrow-down" aria-hidden="true"></i>  &nbsp SCROLL DOWN</button>
            </div>
            <div class = "mountain-bck">
            <!-- <img src="bckgrnd/sky.png" srcset="bckgrnd/sky-p-500.png 500w, bckgrnd/sky-p-800.png 800w, bckgrnd/sky-p-1080.png 1080w, bckgrnd/sky.png 1920w" sizes="(max-width: 1920px) 50%, 1920px" alt="" class="sky"> -->
            <div class = "ground-bck"> 

            </div>
            </div>
        
        </div>
        
        
        
        <section class="section" style="margin-right: 10%;">
  
  <div class="content" style="margin-right: 10%;">
                <h1>Experience New <h1>Level of Adventures</h1></h1>
                <hr>
                <p> You can find various hiking groups each with a different adventure. Hiking groups are updated and organized for you to choose the prefered group. Not interested in any of the groups available? You can suggest a group and one of our admins will review your request and add the hiker group.</p>

  </div>
  <img src="bckgrnd/m2.jpg" class="image" width="500" height="500"/>
</section>

<section class="section">
<img src="bckgrnd/m3.jpg" class="image" width="500" height="500"/>
  <div class="content" style="margin-left: 10%;">
                <h1>Experience New <h1>Level of Adventures</h1></h1>
                <hr>
                <p> You can find various hiking groups each with a different adventure. Hiking groups are updated and organized for you to choose the prefered group. Not interested in any of the groups available? You can suggest a group and one of our admins will review your request and add the hiker group.</p>

  </div>
  
</section>
<section class="section" style="margin-right: 10%;">
  
  <div class="content2" style="margin-right: 10%;">
                <h1>Experience New <h1>Level of Adventures</h1></h1>
                <hr>
                <p> You can find various hiking groups each with a different adventure. Hiking groups are updated and organized for you to choose the prefered group. Not interested in any of the groups available? You can suggest a group and one of our admins will review your request and add the hiker group.</p>

  </div>
  <img src="bckgrnd/m4.jpg" class="image" width="500" height="500"/>
</section>
       
        
         <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <footer class="container-fluid bg-grey py-5">
            <div class="container ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="logo-part">
                                <img src="bckgrnd/logo.png" class="w-75 logo-footer" >
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