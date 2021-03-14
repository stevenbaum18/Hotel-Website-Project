<?php
include("permissions.php");
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
  or die ('Could not connect to the database server' . mysqli_connect_error());
session_start();
$username = $_SESSION["username"];
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
<li><a href="Chains.php">Chains</a></li>
<li><a href="landing.php">Map</a></li>

<?php 
if($_SESSION['loggedin'] == true ){
  echo '<li ><a href="myReservations.php">Your Reservations</a></li>';
}
if( $_SESSION['loggedin'] == true && strcmp($_SESSION["admin1"],'yes') ==0){
  echo '<li><a href="hotelCreatorOne.php">Hotel Creation</a></li>';
  echo '<li class = "active"><a href="allReservationsTwo.php">View All Reservations</a></li>';
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
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Location</th>
      <th scope="col">Username</th>
      <th scope="col">Hotel Chain</th>
      <th scope="col">Room Type</th>
      <th scope="col">Date Booked</th>
      <th scope="col">From Date</th>
      <th scope="col">To Date</th>
      <th scope="col"># of Rooms</th>
      <th scope="col">Price</th>
      <th scope="col">Cancel</th>
    </tr>
  </thead>
  <tbody>
   <?php
    $chainCheckQuery = "SELECT id,username, hotelChain, hotelLocation, roomType, dateBooked, fromDate, toDate,price, amtRoom FROM `reservations` WHERE hotelChain = 'Chain 2'";
    $chainCheck = mysqli_query($con,$chainCheckQuery)or die("Well that didn't work");
    $num_results = mysqli_num_rows($chainCheck);

    for($i = 1; $i <= $num_results; $i++ ){
      echo '<form action="cancelReservation.php" method="post">';
      echo '<tr>';
      $row = mysqli_fetch_array($chainCheck);
       echo '<input type = "hidden" name = "id" '. 'value ="' . $row['id'].'">';
      echo '<input type = "hidden" name = "location" '. 'value ="' . $row['hotelLocation'].'">';
        echo '<th name = "location" scope ="row" '. 'value ="' . $row['hotelLocation'] .'">'  . $row['hotelLocation'] . '</th>';
         echo '<input type = "hidden" name = "username" '. 'value ="' .$row['username'] .'" >';
        echo '<td name ="username" ' . 'value = "'. $row['username'] .'" >' . $row['username'] . '</td>';
         echo '<input type = "hidden" name = "hotelChain" '. 'value ="' .$row['hotelChain'] .'" >';
        echo '<td name ="hotelChain" ' . 'value = "'. $row['hotelChain'] .'" >' . $row['hotelChain'] . '</td>';
         echo '<input type = "hidden" name = "roomType" '. 'value ="' .$row['roomType'] .'" >';
        echo '<td name ="roomType" ' . 'value = "'. $row['roomType'] .'" >' . $row['roomType'] . '</td>';
         echo '<input type = "hidden" name = "dateBooked" '. 'value ="' .$row['dateBooked'] .'" >';
        echo '<td name ="dateBooked"' . 'value ="' . $row['dateBooked'] .'" >' . $row['dateBooked'] . '</td>';
         echo '<input type = "hidden" name = "fromDate" '. 'value ="' . $row['fromDate'] .'">';
        echo '<td name ="fromDate"' . 'value ="' . $row['fromDate'] .'">' . $row['fromDate'] . '</td>';
         echo '<input type = "hidden" name = "toDate" '. 'value ="' . $row['toDate'] .'" >';
        echo '<td name =" toDate"' . 'value ="' . $row['toDate'] .'" >' . $row['toDate'] . '</td>';
         echo '<input type = "hidden" name = "amtRoom" '. 'value ="' . $row['amtRoom'] .'" >';
        echo '<td name =" amtRoom"' . 'value ="' . $row['amtRoom'] .'" >' . $row['amtRoom'] . '</td>';
          echo '<input type = "hidden" name = "price" '. 'value ="' .  $row['price'] .'" >';
        echo '<td name =" price"' . 'value ="' . $row['price'] .'" >' . '$' . $row['price'] . '</td>';
        echo '<td name ="submit" ><button class="btn btn-default btn-lg" type = "submit">Cancel</button></td>';
        echo '</tr>';
        echo '</form>';
    }
    ?>
 </tbody>
</table>
</body>
</html>