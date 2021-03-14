<?php

include("permissions.php");
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
  or die ('Could not connect to the database server' . mysqli_connect_error());
session_start();


//$con->close();

//$con->close();

//$con->close();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    session_start();
    $hotelChain = "Marriot";
    $hotelLocationI = mysqli_real_escape_string($con,$_POST["locationI"]);
    $hotelLocationJ = mysqli_real_escape_string($con,$_POST["locationJ"]);
    $numLux = mysqli_real_escape_string($con,$_POST["numLux"]);
    $numStan = mysqli_real_escape_string($con,$_POST["numStan"]);
    $priceLux = mysqli_real_escape_string($con,$_POST["priceLux"]);
    $priceStan = mysqli_real_escape_string($con,$_POST["priceStan"]);
       $keywords = "standard" ." " . "luxury" ." " . "marriot" ." ". $priceLux . " ".$priceStan;
    echo $hotelLocationI . " " . $hotelLocationJ . " " . $numLux . " " . $numStan ." " . $priceLux . " " . $priceStan;
    //check if hotel exists in that I location
    $hotelIcheckquery = "SELECT `hotelLocationI` FROM `hotel` WHERE hotelLocationI = '" . $hotelLocationI . "'";
    $hotelcheckI = mysqli_query($con, $hotelIcheckquery)or die("1");
    //check if hotel exists in that J location
    $hotelJcheckquery = "SELECT `hotelLocationJ` FROM `hotel` WHERE hotelLocationJ = '" . $hotelLocationJ . "'";
    $hotelcheckJ = mysqli_query($con, $hotelJcheckquery)or die("2");
    if(mysqli_num_rows($hotelcheckI) >0 && mysqli_num_rows($hotelcheckJ) > 0){
    
        $_SESSION["ErrorCtwo"] = "hotel already exists"; // error code 3 name exists cannot register
        header("Location: hotelCreatorOne.php");
        exit();
    }

    //add hotel to table

    $inserthotelquery = "INSERT INTO `bast8620`.`hotel`
(`id`, `hotelChain`, `hotelLocationI`, `hotelLocationJ`, `numLuxury`, `numStandard`, `priceLuxury`, `priceStandard`,`keywords`)
VALUES (NULL, '$hotelChain', '$hotelLocationI', '$hotelLocationJ', '$numLux','$numStan', '$priceLux', '$priceStan','$keywords')";

mysqli_query($con, $inserthotelquery) or die("4: Insert hotel query failed"); //error code 4  insertquery failed
    //    echo "success";
        $_SESSION["ErrorCthree"] = "Success";
    header("Location: hotelCreatorThree.php");
    exit;
}
?>
<html>
<head>
    <title>Chain 3 Hotel Creator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="signup.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="landing.php"><i class="fa fa-building-o" aria-hidden="true"></i>Hotels</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="landing.php">Home</a></li>
                    <li><a href="About.html">About</a></li>
                    <li><a href="Chains.php">Chains</a></li>
                    <?php 
if($_SESSION['loggedin'] == true && $_SESSION["admin1"] == "no"  ){
  echo '<li><a href="myReservations.php">Your Reservations</a></li>';
}
if($_SESSION["admin2"] == "yes"){
  echo '<li class="active"><a href="hotelCreator.php">Hotel Creation</a></li>';
  echo '<li><a href="allReservationsThree.php">View All Reservations</a></li>';
}
?>
                </ul>
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                        if($_SESSION['loggedin'] == false){
                   echo '<li ><a href="hotelSignUp.php">Sign Up</a></li>';
                   echo '<li ><a href="hotelLog.php">Login</a></li>';
                }
                else{echo'<li> <a href="hotelLogOut.php">Log Out</a></li>';

                }?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <form action="" method="post" class="form">
        <br>
        <br>
        <br>
        Location i:<br>
        <input type="text" id="locationI" name="locationI" class="input" placeholder="location i" required minlength="1" maxlength="5">
        </br>
        Location j:<br>
        <input type="text" id="location j" name="locationJ" class="input" placeholder="Location j" required minlength="1" maxlength="5">
        </br>
         Number of Luxury Rooms:<br>
        <input type="text" id="numLux" name="numLux" class="input" placeholder="Luxury Rooms" required minlength="1" maxlength="5">
        </br>
        Number of Standard Rooms:<br>
        <input type="text" id="numStan" name="numStan" class="input" placeholder="Standard Rooms" required minlength="1" maxlength="5">
        </br>
        Price Luxury:<br>
        <input type="text" id="locationI" name="priceLux" class="input" placeholder="Luxury Price" required minlength="1" maxlength="5">
        </br>
        Price Standard:<br>
        <input type="text" id="location j" name="priceStan" class="input" placeholder="Price Standard" required minlength="1" maxlength="5">
        </br>
        <input type="submit" name="register" class="button ">
        </br>
        <br>
     </br>
        <?php
        if(isset($_SESSION["ErrorCthree"])){ // checks if there is an error message set
        echo '<p class = "statusMessage">' .$_SESSION["ErrorCthree"].'</p>'; // Outputs error message to user
    }
        ?>
    </form>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.js"
        integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>
<script src=" https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>