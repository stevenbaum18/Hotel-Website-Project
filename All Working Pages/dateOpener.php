<?php
include("permissions.php");
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
  or die ('Could not connect to the database server' . mysqli_connect_error());
session_start();
?>
<html>
<head>
	<title>Hotel</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="app.css">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
		<div id="content">
			<h1>Input Date</h1>
			<div class = "form-group col-lg-2">
				<form action="dateTrack.php" method="post" class="form">
        Input Current Date mm/dd/yy<br>
        <input type ="date" name ="currentDate" class = "form-control" required>
         <input type="submit" class="form-control" name="register" class="button">
    </div>
</form>
		</div>
	</div>
</div>
</div>
</body>
</html>