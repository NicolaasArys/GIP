<?php
    include 'connect.php';
    session_start();
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
    </head>
    <body>
        <canvas id="canvas" style="position: fixed"></canvas> 
        <nav class="nav">
            <i><a class="nav-login" href="index.php"> Login </a></i>
            <i><a class="nav-login">/</a></i>
            <i><a class="nav-login" href="registreren.php"> Registreren </a></i>
             <title>Advent Calender</title>
        </nav>
        <div id="main">
            <div class="login">
                <?php
                if(isset( $_SESSION['GebruikerId'])) {
                    echo header('location: home.php');
                }
                if(isset($_POST['GebruikerNaam'])) {
                    if($_POST['Wachtwoord'] == $_POST['Wachtwoord2']){
                        $GebruikerEmail = $_POST['GebruikerEmail'];
                        $GebruikerNaam = $_POST['GebruikerNaam'];
                        $Wachtwoord =$_POST['Wachtwoord'];
                        $GebruikerAvatar =$_POST['GebruikerAvatar'];
                        $hashpassword = md5(rand(0,1000));
                        $password_hash = password_hash($Wachtwoord, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO tblgebruikers (GebruikerEmail, GebruikerNaam, Wachtwoord, GebruikerAvatar) VALUES (
                                '".$GebruikerEmail."', 
                                '".$GebruikerNaam."',
                                '".$password_hash."',
                                '".$GebruikerAvatar."'
                                )";
                        $resultaat = $conn->query("select count(*) as aantal from tblgebruikers where GebruikerEmail = '".$GebruikerEmail."'");
                        $row = $resultaat->fetch_assoc();
                        if ($row['aantal'] == 0){
                            if ($conn->query($sql)) {
                            $_SESSION["GebruikerEmail"] = $GebruikerEmail;
                            } else {
                            echo "Error record toevoegen: ". $conn->error."<br>";
                            }
                        }else{
                        echo "Email bestaat al probeer opnieuw<br>";
                        }
                    }else{
                        echo "Error record toevoegen: wachtwoord komt niet overeen";
                    }    
                }
                ?>
                <section>
                    <h2>Registeren</h2>
                    <form method="post" action="regristreren.php" >
                        <label>Naam</label>
                        <input type="text" name="GebruikerNaam" placeholder="" required=""  maxlength='20' class="input-box">
                        <label>Email</label>
                        <input type="Email" name="GebruikerEmail" placeholder="" required=""  maxlength='75' class="input-box">
                        <label>Avatar url (optioneel)</label>
                        <input type="text" name="GebruikerAvatar" placeholder="" class="input-box">
                        <label>Wachtwoord</label>
                        <input type="password" name="Wachtwoord" placeholder="" required="" minlength='5' class="input-box">
                        <label>Herhaal wachtwoord</label>
                        <input type="password" name="Wachtwoord2" placeholder="" required="" minlength='5' class="input-box"> <br/>
                        <input class="shop-add" type="submit" value="Registeren">
                    </form>
                </section>  
            </div>
        </div>
    </body>
</html>
