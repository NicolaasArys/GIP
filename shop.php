<?php
    include 'connect.php';
    session_start();
    if(!isset( $_SESSION['GebruikerId'])) {
        echo header('location: index.php');
    }  
    $sql = $conn->query("select *  from tblgebruikers where GebruikerEmail = '{$_SESSION['GebruikerEmail']}'");
    $row = mysqli_fetch_array($sql);
    $Punten = $row['Punten'];
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="Javascript/sneew.js"></script>
        <link rel="icon" type="image/png" href="images/favicon.png"/>
        <title>Advent Calender</title>
        <script src="Javascript/sidebar.js"></script>
        <script src="Javascript/general.js"></script>
    </head>
    <body>
        <canvas id="canvas" style="position: fixed"></canvas> 
        <!-- Navigation -->
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
            <!-- Search -->
            <div class="row">
                <div class="search-container">
                    <form method="post" action="shop.php">
                        <input type="text" placeholder="Search item..." autocomplete="off" name="search">
                        <button type="submit" class="button"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="row">
                <!-- Shopping Item -->
                <?php
                if(isset($_POST['search']) && !empty($_POST['search'])){
                    $search = "%{$_POST['search']}%";
                    $query = $conn->prepare("SELECT ProductId, ProductNaam, ProductAvatar, ProductKost, ProductOmschrijving FROM tblproduct WHERE ProductNaam like ?");
                    $query->bind_param("s", $search);
                    mysqli_stmt_execute($query);
                    mysqli_stmt_store_result($query);
                    mysqli_stmt_bind_result($query, $ProductId, $ProductNaam, $ProductAvatar, $ProductKost, $ProductOmschrijving);
                    if(mysqli_stmt_num_rows($query) == 0){
                        echo "No search results";
                    }else{
                        $count = 0;
                        while(mysqli_stmt_fetch($query)){
                            if($count%4 == 0){
                                echo "<div class='row'>";
                            }
                            $count++;
                            ?>
                            <div class="three columns" align="center">
                                <img src="<?php echo $ProductAvatar;?>" class="u-full-width shop-photo">
                                <div style="font-size: 2rem;"><?php echo $ProductNaam;?></div>
                                <div><?php echo $ProductOmschrijving;?></div>
                                <div>Kost: <?php echo $ProductKost;?> punten</div>
                                <form method='post' action='shop.php?action=add&id=<?php echo $ProductId; ?>'>
                                    <input type='hidden' name='ProductNaam' value='<?php echo $ProductNaam;?>'>
                                    <input type='hidden' name='ProductKost' value='<?php echo $ProductKost;?>'>
                                    <input type='hidden' name='ProductOmschrijving' value='<?php echo $ProductOmschrijving;?>'>
                                    <button type="submit" name="add" class="shop-add"><i class="fas fa-shopping-cart fa-lg"></i></button>
                                </form>
                            </div>    
                            <?php
                        }
                    }
                }else {
                    $sql = mysqli_query($conn, "SELECT * FROM tblproduct");
                    $count = 0;
                    while($row = mysqli_fetch_array($sql)){
                        if($count%4 == 0){
                            echo "<div class='row'>";
                        }
                        $count++;
                        $ProductId = $row['ProductId'];
                        $ProductNaam = $row['ProductNaam'];
                        $ProductOmschrijving = $row['ProductOmschrijving'];
                        $ProductAvatar = $row['ProductAvatar'];
                        $ProductKost = $row['ProductKost'];
                ?>
                <div class="three columns" align="center">
                    <img src="<?php echo $ProductAvatar;?>" class="u-full-width shop-photo">
                    <div style="font-size: 2rem;"><?php echo $ProductNaam;?></div>
                    <div><?php echo $ProductOmschrijving;?></div>
                    <div>Kost: <?php echo $ProductKost;?> punten</div>
                    <form method='post' action='shop.php?action=add&id=<?php echo $ProductId; ?>'>
                        <input type='hidden' name='ProductAvatar' value='<?php echo $ProductAvatar;?>'>
                        <input type='hidden' name='ProductNaam' value='<?php echo $ProductNaam;?>'>
                        <input type='hidden' name='ProductKost' value='<?php echo $ProductKost;?>'>
                        <input type='hidden' name='ProductOmschrijving' value='<?php echo $ProductOmschrijving;?>'>
                        <button type="submit" name="add" class="shop-add"><i class="fas fa-shopping-cart fa-lg"></i></button>
                    </form>
                </div>
                <?php
                        }   
                    }
                ?> 
            </div>
        </div>
        <!-- Shopping Cart -->
        <?php
        if(isset($_POST['add'])){
            if(isset($_SESSION['shopping_cart'])){
                $item_array_id = array_column($_SESSION["shopping_cart"], "ProductId");
                if(!in_array($_GET["id"], $item_array_id)){
                    $count = count($_SESSION["shopping_cart"]);
                    $item_array = array(
                        'ProductId'   => $_GET['id'],
                        'ProductAvatar'   => $_POST["ProductAvatar"],
                        'ProductNaam'   => $_POST["ProductNaam"],
                        'ProductKost'   => $_POST["ProductKost"],
                        'ProductOmschrijving'   => $_POST["ProductOmschrijving"]
                    );
                    $_SESSION["shopping_cart"][$count] = $item_array;
                }else{
                    echo '<script>alert("Item Already Added!")</script>';
                    echo '<script>window.location="shop.php"</script>';
                }
            }else{
                $item_array = array(
                    'ProductId'   => $_GET['id'],
                    'ProductAvatar'   => $_POST["ProductAvatar"],
                    'ProductNaam'   => $_POST["ProductNaam"],
                    'ProductKost'   => $_POST["ProductKost"],
                    'ProductOmschrijving'   => $_POST["ProductOmschrijving"]
                );
                $_SESSION["shopping_cart"][0] = $item_array;
            }
        }
        if(isset($_GET["action"])){
            if($_GET["action"] == "delete"){
                foreach($_SESSION["shopping_cart"] as $keys => $values){
                    if($values["ProductId"] == $_GET["id"]){
                        unset($_SESSION["shopping_cart"][$keys]);
                        echo '<script>alert("Item Removed")</script>';
                        echo '<script>window.location="shop.php"</script>';
                    }
                }
            }
        }
        ?>
        
            
        <button class="shopping-cart-button" onclick="openCart()">❮</button>
        <div id="myCart" class="cart-sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeCart()">×</a>
            <div class="shop-list">
                <h3>Shopping Cart</h3>
                <?php
                $total = 0;
                    if(!empty($_SESSION["shopping_cart"])){
                        
                        foreach($_SESSION["shopping_cart"] as $keys => $values){
                            
                            ?>
                            <div class="row" style="margin-bottom: 5px;">
                                <div style="display:inline-block;vertical-align:top;">
                                    <img src="<?php echo $values['ProductAvatar'];?>" class="u-full-width shop-photo-cart">
                                </div>
                                <div style="display:inline-block;vertical-align:top;">
                                    <div class="shop-cart-text"><?php echo $values['ProductNaam'];?></div>
                                    <div class="shop-cart-text"><?php echo $values['ProductKost']?> Points</div>
                                    <a href="shop.php?action=delete&id=<?php $item_id = $values["ProductId"];echo $item_id; ?>">Remove</a>
                                </div>
                            </div>
                            <?php
                            $total += $values['ProductKost']; 
                        }

                    }
                ?>
                <div style="margin-top: 50px;">
                    <h4>My points: <?php echo $Punten;?></h4>
                    <?php
                        if($Punten >= $total){
                            echo "<h4>Total: ".$total." points</h4>";
                        }else {
                            echo "<h4 style='color: red'>Total: ".$total." points</h4>";
                        }
                    ?>
                    <button class="shop-order-button">Order</button>
                </div>
            </div>
        </div>
    </body>
</html>