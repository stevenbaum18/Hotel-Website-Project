<?php
include("permissions.php");
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
  or die ('Could not connect to the database server' . mysqli_connect_error());
session_start();
?>
<html lang="en">

<head>
	<title>likeHome</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i" rel="stylesheet">

	<link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.css">

	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">

	<link rel="stylesheet" href="css/aos.css">

	<link rel="stylesheet" href="css/ionicons.min.css">

	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="css/jquery.timepicker.css">


	<link rel="stylesheet" href="css/flaticon.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class=" nav">
	      <a class="navbar-brand" href="about.php">likeHome</a>

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
					<li class="nav-item active margin" ><a href="about.php" class="nav-link" style="font-size: larger;"><b>Home</b></a></li>
					<li class="nav-item"><a href="chains.php" class="nav-link" style="font-size: larger;" ><b>chains</b></a></li>
					<li class="nav-item"><a href="map.php" class="nav-link" style="font-size: larger;"><b>Map</b></a></li>
					                 <?php 
if($_SESSION['loggedin'] == true && $_SESSION["admin3"] == "no"  ){
  echo '<li class ="nav-item"><a href="myReservations.php">Your Reservations</a></li>';
}
if($_SESSION["admin3"] == "yes"){
  echo '<li class ="nav-item"><a href="hotelCreatorThree.php">Hotel Creation</a></li>';
  echo '<li class ="nav-item"><a href="allReservationsThree.php">View All Reservations</a></li>';
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
    <!-- END nav -->

	<section class="home-slider js-fullheight owl-carousel">
		<div class="slider-item js-fullheight" style="background-image:url(images/Hotel3.jpg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row slider-text justify-content-center align-items-center">

					<div class="col-md-7 col-sm-12 text-center ftco-animate">
						<h1 class="mb-3 mt-2 bread">Westin</h1>
						<p class="breadcrumbs" style = "color: #0c0c0c ;"><span class="mr-2"><a href="chains.php" style = "color: #0c0c0c ;"><b>Chains</b></a></span>
							<span><b>Chain Three</b></span></p>
					</div>

				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section ftco-room">
		<div class="container">
			<div class="row justify-content-md-center">
							<?php
    $chainCheckQuery = "SELECT id,hotelChain, hotelLocationI, hotelLocationJ, numLuxury, priceLuxury, numStandard, priceStandard FROM `hotel` WHERE hotelChain = 'Westin'";
    $chainCheck = mysqli_query($con,$chainCheckQuery)or die("Well that didn't work");
    $num_results = mysqli_num_rows($chainCheck);

    for($i = 1; $i <= $num_results; $i++ ){
    	
						echo	'<div class="col-md-4">
					<div class="room-wrap ftco-animate">
						<a href="" class="img" style="background-image: url(images/chain1hotel1.jpg);"></a>
						<div class="text pt-4 pl-lg-5">';
						 echo '<form action="reservationTest.php" method="post">';
						  echo '<input type = "hidden" name = "hotelChain" value ="Westin" >';
								$row = mysqli_fetch_array($chainCheck);
								echo '<input type = "hidden" name = "locI" '. 'value ="' . $row['hotelLocationI'] . ',' . $row['hotelLocationJ'] .'">';
							echo '<h2>Location:'  . $row['hotelLocationI'] . "," . $row['hotelLocationJ'] . '</h2>';
							echo '<p class="rate">
								<span class="icon-star"></span>
								<span class="icon-star"></span>
								<span class="icon-star"></span>
								<span class="icon-star"></span>
								<span class="icon-star-half-full"></span>
							</p>';
								 echo '<input type = "hidden" name = "numLux" '. 'value ="' .$row['numLuxury'] .'" >';
							echo '<p class="d-flex price-details align-items-center pt-3">
								<span>Luxury Rooms:' . $row['numLuxury'] . '</span>';
								  echo '<input type = "hidden" name = "priceLux" '. 'value ="' .$row['priceLuxury'] .'" >';
							echo 	'<span class="price">&nbsp;$'. $row['priceLuxury'] . '</span>
							</p>';
							echo '<input type = "hidden" name = "numStan" '. 'value ="' . $row['numStandard'] .'">';
							echo '<p class="d-flex price-details align-items-center pt-3">
								<span>Standard Rooms:' . $row['numStandard'] . '</span>';
								   echo '<input type = "hidden" name = "priceStan" '. 'value ="' . $row['priceStandard'] .'" >';
								echo '<span class="price">&nbsp;$' . $row['priceStandard'] . '</span>
							</p>';
						echo	'<p><button  class="btn-customize" type = "submit">Reserve</button></p>
						</div> </div> </div>';
					
				}
				?>
	</section>

	<footer class="ftco-footer ftco-bg-dark ftco-section">
		<div class="container">
			<div class="row mb-5 d-flex">
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">About likeHome</h2>
						<p style="color:white;font-size:20px;font-weight:bold;">It's not about where you are staying. 
						It's about where you're going. likeHome, Travel Brilliantly</p>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<!-- loader -->
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
				stroke="#F96D00" /></svg></div>


	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-migrate-3.0.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/aos.js"></script>
	<script src="js/jquery.animateNumber.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/scrollax.min.js"></script>
	<script src="js/main.js"></script>
	<script src="https://kit.fontawesome.com/f004f1adc5.js" crossorigin="anonymous"></script>

</body>

</html>