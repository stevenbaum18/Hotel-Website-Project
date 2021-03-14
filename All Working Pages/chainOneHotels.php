<?php
include("permissions.php");
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
  or die ('Could not connect to the database server' . mysqli_connect_error());
session_start();
?>
<html>
<head>
	<title>Chain 1 Hotels</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="hotelView.css">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
    <div id="content">
      
      
      </div>  
    </div>  
  </div>  
</div>

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
      <a class="navbar-brand" href="#"><i class="fa fa-building-o" aria-hidden="true"></i>Hotels</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
<li><a href="landing.php">Home</a></li>
<li class="active"><a href="chainOneHotels.php">Hotels</a></li>
<li ><a href="Chains.php">Chains</a></li>
<li><a href="landing.php">Map</a></li>

<?php 
if($_SESSION['loggedin'] == true ){
  echo '<li><a href="myReservations.php">Your Reservations</a></li>';
}
if( $_SESSION['loggedin'] == true && strcmp($_SESSION["admin1"],'yes') ==0){
  echo '<li><a href="hotelCreatorOne.php">Hotel Creation</a></li>';
  echo '<li><a href="allReservationsOne.php">View All Reservations</a></li>';
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
<?php
        if(isset($_SESSION["dumbError"])){ // checks if there is an error message set
        echo '<h3 class = "statusMessage">' .$_SESSION["dumbError"].'</h3>'; // Outputs error message to user
        unset($_SESSION["dumbError"]);
    }
        ?>
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Location</th>
      <th scope="col">Luxury Rooms Available</th>
      <th scope="col">Luxury Room Price</th>
      <th scope="col">Standard Rooms Available</th>
      <th scope="col">Standard Rooms Price</th>
      <th scope="col">Book</th>
    </tr>
  </thead>
  <tbody>
   <?php
    $chainCheckQuery = "SELECT id,hotelChain, hotelLocationI, hotelLocationJ, numLuxury, priceLuxury, numStandard, priceStandard FROM `hotel` WHERE hotelChain = 'Marriot'";
    $chainCheck = mysqli_query($con,$chainCheckQuery)or die("Well that didn't work");
    $num_results = mysqli_num_rows($chainCheck);

    for($i = 1; $i <= $num_results; $i++ ){
      echo '<form action="chainOneBook.php" method="post">';
      echo '<tr>';
      $row = mysqli_fetch_array($chainCheck);
      echo '<input type = "hidden" name = "locI" '. 'value ="' . $row['hotelLocationI'] . ',' . $row['hotelLocationJ'] .'">';
        echo '<th name = "locI" scope ="row" '. 'value ="' . $row['hotelLocationI'] . ',' . $row['hotelLocationJ'] .'">'  . $row['hotelLocationI'] . "," . $row['hotelLocationJ'] . '</th>';
         echo '<input type = "hidden" name = "numLux" '. 'value ="' .$row['numLuxury'] .'" >';
        echo '<td name ="numLux" ' . 'value = "'. $row['numLuxury'] .'" >' . $row['numLuxury'] . '</td>';
         echo '<input type = "hidden" name = "priceLux" '. 'value ="' .$row['priceLuxury'] .'" >';
        echo '<td name ="priceLux"' . 'value ="' . $row['priceLuxury'] .'" >' . $row['priceLuxury'] . '</td>';
         echo '<input type = "hidden" name = "numStan" '. 'value ="' . $row['numStandard'] .'">';
        echo '<td name ="numStan"' . 'value ="' . $row['numStandard'] .'">' . $row['numStandard'] . '</td>';
         echo '<input type = "hidden" name = "priceStan" '. 'value ="' . $row['priceStandard'] .'" >';
        echo '<td name =" priceStan"' . 'value ="' . $row['priceStandard'] .'" >' . $row['priceStandard'] . '</td>';
        echo '<td name ="submit" ><button class="btn btn-default btn-lg" type = "submit">Book</button></td>';
        echo '</tr>';
        echo '</form>';
    }
    ?>
 </tbody>
</table>
</body>
</html>