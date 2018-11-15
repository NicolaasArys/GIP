<?php
    include 'connect.php';
    session_start();
    if(!isset( $_SESSION['GebruikerId'])) {
        echo header('location: index.php');
    }  
    $resultaat = $conn->query("select *  from tblgebruikers where GebruikerEmail = '{$_SESSION['GebruikerEmail']}'");
?>
<canvas id="canvas" style="position: fixed"></canvas> 
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="author" content="Nicolaas Arys">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/skeleton.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
        <script src="sneew.js"></script>
    </head>
    <body>
        <nav class="nav" >
            <i id="mobile"><a class="fas fa-home fa-lg nav-text nav-margin" href="home.php"> Home </a></i>
            <i id="mobile"><a class="fas fa-shopping-cart fa-lg nav-text nav-margin" href="shop.php"> Shop </a></i>
            <i id="mobile" class="title">Advent_Calendar</i>
            <i id="mobile"><a class="fas fa-user fa-lg nav-text nav-margin" href=""> Profile </a></i>
            <i id="mobile"><a class="fas fa-envelope fa-lg nav-text nav-margin" href=""> Support </a></i>
        </nav>
        <div class="nav-sidebar">
            <ul style="top: 50px;">
                <a href="home.php" class="nav-sidebar-text"><li> <i class="fas fa-home fa-lg"></i> Home</li></a>
                <a href="shop.php" class="nav-sidebar-text"><li> <i class="fas fa-shopping-cart fa-lg"></i> Shop</li></a>
                <a href="" class="nav-sidebar-text"><li> <i class="far fa-user fa-lg"></i> Profile</li></a>
                <a href="" class="nav-sidebar-text"><li> <i class="far fa-envelope fa-lg"></i> Support</li></a>
                <a href="loguit.php" class="nav-sidebar-text"><li> <i class="fas fa-power-off fa-lg"></i> Logout</li></a>
                <li  class="nav-sidebar-text"> <i class="far fa-star fa-lg"></i> Points: <?php echo $_SESSION['Punten'];?></li>
            </ul>
        </div>
        <main>
            
        </main>
    </body>
</html>