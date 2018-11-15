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
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/skeleton.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
        <script src="sneew.js"></script>
    </head>
    <body>
        <canvas id="canvas" style="position: fixed"></canvas> 
        <nav class="nav">
            <i><a class="nav-login" href="index.php"> Login </a></i>
            <i><a class="nav-login">/</a></i>
            <i><a class="nav-login" href="registreren.php"> Registreren </a></i>
        </nav>
        <main>
            <div class="login">
                <?php
                if(isset( $_SESSION['GebruikerId'])) {
                    echo header('location: home.php');
                }
                $error;
                if(isset($_POST['GebruikerEmail'])) {
                    $GebruikerEmail = $_POST['GebruikerEmail'];
                    $password = $_POST['Wachtwoord'];
                    if($_POST['GebruikerEmail'] == null){
                        echo "Fout ingevuld probeer opnieuw.";
                        echo '</br> <a href="index.php">back</a>';
                    }else{
                        if($stmt = $conn->prepare( "select Wachtwoord, GebruikerType, GebruikerId, GebruikerNaam, Punten from tblgebruikers where GebruikerEmail = ?")){
                            $stmt->bind_param("s", $GebruikerEmail);
                            $stmt->execute();
                            $stmt->bind_result($Wachtwoord, $GebruikerType, $GebruikerId, $GebruikerNaam, $Punten);
                            $stmt->fetch();

                            if(password_verify($password, $Wachtwoord )){
                                $_SESSION['GebruikerEmail'] = $GebruikerEmail;
                                $_SESSION['GebruikerType'] = $GebruikerType;
                                $_SESSION['GebruikerId'] =  $GebruikerId;
                                $_SESSION['GebruikerNaam'] = $GebruikerNaam;
                                $_SESSION['Punten'] = $Punten;
                                header('location: home.php');
                            }else {
                                $error = "De combinatie komt niet overeen.";
                            }
                        } else {
                            echo "Fout ingevuld probeer opnieuw.";
                            echo '</br> <a href="index.php">back</a>';
                        }
                    }
                }
                ?>
                <section>
                    <?php
                        if(!empty($error)) {
                            echo "<div class='error'>" . $error . "</div>";
                        }
                    ?>
                    <h2>Login</h2>
                    <form method="post" action="index.php">
                        <div>Email</div>
                        <input type="email" name="GebruikerEmail" required="required">
                        <div>Password</div>
                        <input type="password" name="Wachtwoord" required="required">
                        <div></div>
                        <input type="submit" value="Login">
                    </form>
                </section>
            </div>
        </main>
    </body>
</html>
