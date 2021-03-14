 <?php
include("permissions.php");
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
  or die ('Could not connect to the database server' . mysqli_connect_error());
session_start();
$username = $_SESSION["username"];
?>


 <html lang="en">
  
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
      
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="style.css" />

    <!--for navbar-->
	<link rel="stylesheet" href="navbar/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="navbar/css/style1.css">
    
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar" >
	    <div class=" nav">
	      <a class="navbar-brand" href="index.php">likeHome</a>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
				      <li class="nav-item">
						      <div class="searchbar">
							        <input type="text" name="search" placeholder="Search.." style="width:150px;">
						      </div>
					    </li>
				      <li class="nav-item" >
					    <div class="mb-3 mr-4" style="margin-left:8%; width: 120px;" >
						      <input type="text" class="form-control checkin_date" placeholder="date">
					    </div>
				      </li>
              <li class="nav-item active margin" ><a href="index.php" class="nav-link" style="font-size: larger;"><b>Home</b></a></li>
					    <li class="nav-item"><a href="chains.php" class="nav-link" style="font-size: larger;" ><b>chains</b></a></li>
					    <li class="nav-item"><a href="map.php" class="nav-link" style="font-size: larger;"><b>Map</b></a></li>
										                 <?php 
if($_SESSION['loggedin'] == true && $_SESSION["admin2"] == "no"  ){
  echo '<li class ="nav-item"><a href="myReservations.php">Your Reservations</a></li>';
}
if($_SESSION["admin2"] == "yes"){
  echo '<li class ="nav-item"><a href="hotelCreatorTwo.php">Hotel Creation</a></li>';
  echo '<li class ="nav-item"><a href="allReservationsTwo.php">View All Reservations</a></li>';
}
?>
					<?php 
					if($_SESSION['loggedin' == false]){
					echo'<li class="nav-item"><a href="register and login/index.php" class="nav-link" style="font-size: larger;"><b>Log&nbsp;In</b></a></li>';
					echo '<li class="nav-item"><a href="register and login/register.php" class="nav-link" style = "font-size: larger;" style="font-size: larger;">
					  <b>Sign&nbsp;Up</b></a></li>';
					}else{
						echo '<li class="nav-item"><a href="hotelLogOut.php" class="nav-link" style="font-size: larger;"><b>Log&nbsp;Out</b></a></li>';
					}
					?>
	        </ul>
	      </div>
	    </div>
	  </nav>
    
    <div class="container-fluid inner">
        <table class="tableizer-table">
        <tr class="tableizer-firstrow">
        	<th>Hotel Location</th>
            <th>Name</th>
            <th>Hotel Chain</th>
            <th>Room Type</th>
            <th>Arrival Date</th>
            <th>Departure Date</th>
            <th># of Rooms</th>
            <th>Price</th>
            <th>Cancel</th>
  <?php
    $chainCheckQuery = "SELECT id,username, hotelChain, hotelLocation, roomType, dateBooked, fromDate, toDate,price, amtRoom FROM `reservations` WHERE hotelChain = 'Courtyard'" ;
    $chainCheck = mysqli_query($con,$chainCheckQuery)or die("Well that didn't work");
    $num_results = mysqli_num_rows($chainCheck);

    for($i = 1; $i <= $num_results; $i++ ){
      if($_SESSION['currentDate'] < $toDate && $_SESSION['currentDate'] > $fromDate){
      echo '<form action="cancelReservation.php" method="post">';
      echo '<tr>';
      $row = mysqli_fetch_array($chainCheck);
       echo '<input type = "hidden" name = "id" '. 'value ="' . $row['id'].'">';
      echo '<input type = "hidden" name = "location" '. 'value ="' . $row['hotelLocation'].'">';
        echo '<td name = "location" scope ="row" '. 'value ="' . $row['hotelLocation'] .'">'  . $row['hotelLocation'] . '</th>';
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
    }
    ?>
    </table>
      
    </div>

      <!--all the javascript for date, navbar-->
      <script src="navbar/js/jquery.min.js"></script>
        <script src="navbar/js/jquery-migrate-3.0.1.min.js"></script>

        <script src="navbar/js/jquery.waypoints.min.js"></script>
        <script src="navbar/js/jquery.stellar.min.js"></script>
        <script src="navbar/js/owl.carousel.min.js"></script>
        
        <script src="navbar/js/jquery.magnific-popup.min.js"></script>
        <script src="navbar/js/aos.js"></script>
        
        <script src="navbar/js/bootstrap-datepicker.js"></script>
        <script src="navbar/js/scrollax.min.js"></script>
        <script src="navbar/js/main.js"></script>

</body>

</html>