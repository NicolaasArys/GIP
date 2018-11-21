<?php
    include 'connect.php';
    session_start();
    if(!isset( $_SESSION['GebruikerId'])) {
        echo header('location: index.php');
    }  
    $query = mysqli_query($conn, "select *  from tblgebruikers where GebruikerEmail = '{$_SESSION['GebruikerEmail']}'");
    $row = mysqli_fetch_array($query);

    $GebruikerNaam = $row['GebruikerNaam'];
    $GebruikerAvatar = $row['GebruikerAvatar'];
    $GebruikerEmail = $row['GebruikerEmail'];
    $Punten = $row['Punten'];
    $GebruikerId = $row['GebruikerId'];
?>
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
            <div class="row">
                <div class="u-full-width">
                    <h1>Profile</h1>
                </div>
                <div class="u-full-width">
                    
                    <div class="three columns" align="center">
                    <img src="<?php echo $GebruikerAvatar;?>" class="profile-avatar u-full-width" onerror="this.src='images/user.png'">
                    </div>
                    <div class="five columns" style="border: 3px solid black">
                        <div style="font-size: 25px;">Name: </div>
                        <input class="u-full-width" type="text" placeholder="<?php echo $GebruikerNaam;?>" name="Naam" value="<?php echo $GebruikerNaam;?>">
                        <div style="font-size: 25px;">Email: </div>
                        <input class="u-full-width" type="text" placeholder="<?php echo $GebruikerEmail;?>" name="Naam" value="<?php echo $GebruikerEmail;?>">
                        <div style="font-size: 25px;">Avatar: </div>
                        <input class="u-full-width" type="text" placeholder="<?php echo $GebruikerAvatar;?>" name="Naam" value="<?php echo $GebruikerAvatar;?>">
                        <div style="font-size: 25px;">Punten: <?php echo $Punten;?></div>
                    </div>
                    <div class="four columns" style="border: 3px solid black">
                        <ul style="padding-top: 5px">
                            <il><a class="fas fa-cogs fa-lg" > Settings</a></il>
                        </ul>
                    </div>
                    
                    
                </div>      
            </div>
        </div>
    </body>
</html>