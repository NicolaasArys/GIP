<?php
    include 'connect.php';
    session_start();
    if(!isset( $_SESSION['GebruikerId'])) {
        echo header('location: index.php');
    }  
    $query = mysqli_query($conn, "select *  from tblgebruikers where GebruikerEmail = '{$_SESSION['GebruikerEmail']}'");

    $row = mysqli_fetch_array($query);
    $GebruikerEmail = $row['GebruikerEmail'];
    
?>
<!DOCTYPE>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="author" content="Nicolaas Arys">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/skeleton.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
        <script src="Javascript/sneew.js"></script>
        <link rel="icon" type="image/png" href="images/favicon.png"/>
        <title>Advent Calender</title>
        <script src="Javascript/sidebar.js"></script>
    </head>
    <body>
        <canvas id="canvas" style="position: fixed"></canvas> 
        <nav class="nav">
            <button class="openbtn u-pull-left" onclick="openNav()">☰</button> 
            <i id="mobile"><a class="fas fa-home fa-lg nav-text nav-margin" href="home.php"> Home </a></i>
            <i id="mobile"><a class="fas fa-shopping-cart fa-lg nav-text nav-margin" href="shop.php"> Shop </a></i>
            <b class="title">Advent Calendar</b>
            <i id="mobile"><a class="fas fa-user fa-lg nav-text nav-margin" href="profile.php"> Profile </a></i>
            <i id="mobile"><a class="fas fa-envelope fa-lg nav-text nav-margin" href=""> Support </a></i>
            <i id="mobile"><a class="fas fa-power-off fa-lg nav-text nav-margin-logout u-pull-right" href="loguit.php"> Logout</a></i>
        </nav>
        
        <div id="mySidebar" class="nav-sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <a href="home.php" class="nav-sidebar-text"><li> <i class="fas fa-home fa-lg"></i> Home</li></a>
            <a href="shop.php"><li> <i class="fas fa-shopping-cart fa-lg"></i> Shop</li></a>
            <a href="profile.php"><li> <i class="far fa-user fa-lg"></i> Profile</li></a>
            <a href=""><li> <i class="far fa-envelope fa-lg"></i> Support</li></a>
            <a href="loguit.php"><li> <i class="fas fa-power-off fa-lg"></i> Logout</li></a>
        </div>
        <div id="main">
            <div class="login">
                <section>
                    <h2 style="text-align: center;">Support</h2>
                    <form method="post" action="sendMail.php" style="font-size: 25px;text-align: center;">
                        <div>Email</div>
                        <div class="support-email"><?php echo $GebruikerEmail ;?></div>
                        <div>Subject</div>
                        <input type="text" name="subject" placeholder="Subject" class="u-full-width">
                        <div>Bericht</div>
                        <textarea placeholder="Message" name="message" class="support-message u-full-width" maxlength="5000"></textarea>
                        <div>
                            <button type="submit" name="submit" class="shop-add">Send</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </body>
</html>