<?php
    include 'connect.php';
    session_start();
    if(!isset( $_SESSION['GebruikerId'])) {
        echo header('location: index.php');
    }  

    if(isset($_POST['name'])){
        $query = $conn->prepare("UPDATE tblgebruikers SET GebruikerNaam = ? where GebruikerId = '".$_SESSION['GebruikerId']."' ");
        $query->bind_param("s", $_POST['name']);
        mysqli_stmt_execute($query);
    }
    if (isset($_POST['email'])){        
        $query = $conn->prepare("UPDATE tblgebruikers SET GebruikerEmail = ? where GebruikerId = '".$_SESSION['GebruikerId']."' ");
        $query->bind_param("s", $_POST['email']);
        mysqli_stmt_execute($query);
    }
    if (isset($_POST['avatar'])){
        $query = $conn->prepare("UPDATE tblgebruikers SET GebruikerAvatar = ? where GebruikerId = '".$_SESSION['GebruikerId']."' ");
        $query->bind_param("s", $_POST['avatar']); 
        mysqli_stmt_execute($query);
    }
    if (isset($_POST['wachtwoordveranderen'])){
        $wachtwoord1veranderen = $_POST['wachtwoordveranderen'];
        $wachtwoord2veranderen = $_POST['Repeatwachtwoordveranderen'];
        if ($wachtwoord1veranderen === $wachtwoord2veranderen){
            ?>
               <div id="alert()"></div> 
            <?php
        }
    }

    $sql = mysqli_query($conn, "select *  from tblgebruikers where GebruikerId = '".$_SESSION['GebruikerId']."'");
    $row = mysqli_fetch_array($sql);

    $GebruikerNaam = $row['GebruikerNaam'];
    $GebruikerEmail = $row['GebruikerEmail'];
    $GebruikerAvatar = $row['GebruikerAvatar'];
    $Punten = $row['Punten'];
    
?>
<html>
    <head>
        <title>Advent Calender</title>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="author" content="Nicolaas Arys">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/skeleton.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
        <link rel="icon" type="image/png" href="images/favicon.png"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="Javascript/sneew.js"></script>
        <script src="Javascript/sidebar.js"></script>
        <script src="Javascript/general.js"></script>
        
    </head>
    <body>
        <canvas id="canvas" style="position: fixed"></canvas> 
        <nav class="nav">
            <button class="openbtn u-pull-left" onclick="openNav()">☰</button> 
            <i id="mobile"><a class="fas fa-home fa-lg nav-text nav-margin" href="home.php"> Home </a></i>
            <i id="mobile"><a class="fas fa-shopping-cart fa-lg nav-text nav-margin" href="shop.php"> Shop </a></i>
            <b class="title">Advent Calendar</b>
            <i id="mobile"><a class="fas fa-user fa-lg nav-text nav-margin" href="profile.php"> Profile </a></i>
            <i id="mobile"><a class="fas fa-envelope fa-lg nav-text nav-margin" href="support.php"> Support </a></i>
            <i id="mobile"><a class="fas fa-power-off fa-lg nav-text nav-margin-logout u-pull-right" href="loguit.php"> Logout</a></i>
        </nav>
        <div id="mySidebar" class="nav-sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <a href="home.php" class="nav-sidebar-text"><li> <i class="fas fa-home fa-lg"></i> Home</li></a>
            <a href="shop.php"><li> <i class="fas fa-shopping-cart fa-lg"></i> Shop</li></a>
            <a href="profile.php"><li> <i class="far fa-user fa-lg"></i> Profile</li></a>
            <a href="support.php"><li> <i class="far fa-envelope fa-lg"></i> Support</li></a>
            <a href="loguit.php"><li> <i class="fas fa-power-off fa-lg"></i> Logout</li></a>
        </div>
        <div id="main">
            <div class="row">
                <div class="u-full-width">
                    <h1>Profile</h1>
                </div>
                <div class="u-full-width">
                    
                    <div class="five columns" align="center">
                        <img src="<?php echo $GebruikerAvatar;?>" class="profile-avatar u-full-width" onerror="this.src='images/user.png'">
                    </div>
                    <div class="seven columns profile-box">
                        <form method="post" action="profile.php">
                            <div style="font-size: 25px;">Name: </div>
                            <input class="u-full-width" type="text" required="" autocomplete="off" placeholder="<?php echo $GebruikerNaam;?>" name="name" value="<?php echo $GebruikerNaam;?>">
                            <div style="font-size: 25px;">Email: </div>
                            <input class="u-full-width" type="Email" required="" autocomplete="off" placeholder="<?php echo $GebruikerEmail;?>" name="email" value="<?php echo $GebruikerEmail;?>">
                            <div style="font-size: 25px;">Avatar: </div>
                            <input class="u-full-width" type="text" autocomplete="off" placeholder="<?php echo $GebruikerAvatar;?>" name="avatar" value="<?php echo $GebruikerAvatar;?>">
                            <button type="submit" class="hidden"></button>
                            <div style="font-size: 25px;">Punten: <?php echo $Punten;?></div>
                        </form>
                        <ul>
                            <div class="row profile-instelling"> 
                                <label>
                                    <il><div class="fas fa-cogs fa-lg  white" > Settings</div></il>
                                    <input type="checkbox" class="checkbox-dropdown" onclick="displaySetting()">
                                 </label>
                            </div>
                            <form  style="display: none;" id="setting" href="profile.php">
                                <input type="checkbox" class="checkbox-profile" name="mail"/>
                                
                                <label for="checkbox-profile">I want to recieve mails from this website</label>
                            </form>
                            <div class="row profile-instelling"> 
                                <label>
                                    <il><div class="fas fa-unlock fa-lg  white" > Change Password</div></il>
                                    <input type="checkbox" class="checkbox-dropdown" onclick="displayWachtwoord()">
                                </label>
                            </div>
                            
                            <form method="post" action="profile.php" onsubmit="show_alert()">
                                <input type="password" name="wachwoordveranderen" placeholder="Password" required="" autocomplete="off" minlength='5' class="profile-password" id="wachtwoord"/>
                                <input type="password" name="Repeatwachwoordveranderen" placeholder="Repeat password" required="" autocomplete="off" minlength='5' class="profile-password" id="wachtwoordRepeat"/>
                                <input type="submit" style="position: absolute; left: -9999px"/>
                            </form >
                        </ul>
                    </div>
                </div>      
            </div>
        </div>
    </body>
</html>
