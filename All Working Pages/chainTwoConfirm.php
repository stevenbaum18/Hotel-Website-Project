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

     $username = $_SESSION['username'];
    $hotelChain = "Courtyard";
  $location = mysqli_real_escape_string($con,$_POST["location"]);
    $roomType= mysqli_real_escape_string($con,$_POST["roomType"]);
    $currentDate = $_SESSION['currentDate'];
    $fromDate= mysqli_real_escape_string($con,$_POST["fromDate"]);
    $toDate= mysqli_real_escape_string($con,$_POST["toDate"]); 
    $amtRoom = mysqli_real_escape_string($con,$_POST["amtRoom"]);
//below here is not submitted to res table
     $numLux = mysqli_real_escape_string($con,$_POST["numLux"]);
      $priceLux = mysqli_real_escape_string($con,$_POST["priceLux"]);
        $numStan = mysqli_real_escape_string($con,$_POST["numStan"]);
      $priceStan = mysqli_real_escape_string($con,$_POST["priceStan"]);
        list($locationI) = explode(',', $location);
      $locationJ = substr($location, strpos($location, ",") + 1); 
      $price;
      $diff = ($testTo - $testFrom);
      $days = floor($diff / (60*60*24));    

    //  echo "". $username . $roomType . $priceStan . $numStan . $priceLux . $numLux . $location . $amtRoom .  $currentDate . $fromDate  . $toDate .  "  .......     ";

if($roomType == "Luxury" && $numLux < $amtRoom){ 
          echo $_SESSION["dumbError"] = "Amount of Luxury Rooms Requested exceeds amount of rooms available"; 
          header("Location: chainTwoHotels.php");
          exit();
      }
      if($_SESSION['currentDate'] > $fromDate){
        echo $_SESSION["dumbError"] = "Cannot Check in Before Current Date";
        header("Location: chainTwoHotels.php");
        exit();
      }
      if($fromDate >= $toDate){
          echo $_SESSION["dumbError"] = "Cannot Check in before Check Out Date/on Check Out Date";
          header("Location: chainTwoHotels.php");
          exit();
      }
      if($roomType == "Standard" && $numStan < $amtRoom){
          echo $_SESSION["dumbError"] = "Amount of Standard Rooms Requested exceeds amount of rooms available";
         header("Location: chainTwoHotels.php");
         exit();
      }
      if($roomType == "Luxury"){
        $price = $priceLux * $amtRoom;
        $price = $price * $days;
      }else{
        $price = $priceStan * $amtRoom;
        $price = $price * $days;
      }
    
echo "" . $price ."  .....         ";
     if($roomType =="Luxury"){
      $numLux = $numLux - $amtRoom; 
     
     }else{
      $numStan = $numStan - $amtRoom;
       
     }
//echo "" . $price ."  .....         ";
	
  


  if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION["loggedin"] == true && isset($username) && isset($hotelChain) && isset($location) && isset($roomType) && isset($_SESSION['currentDate']) && isset($fromDate) && isset($toDate) && isset($price) ){
$insertresquery = "INSERT INTO `bast8620`.`reservations`
(`id`,`username`,`hotelChain`,`hotelLocation`,`roomType`,`dateBooked`,`fromDate`,`toDate`,`price`,`amtRoom`)
VALUES (NULL, '$username', '$hotelChain', '$location', '$roomType','$currentDate', '$fromDate','$toDate', '$price','$amtRoom')";

if($roomType =="Luxury"){//updates the inventory of luxury rooms
      
      $updatequery = "UPDATE `hotel` SET numLuxury = '$numLux' WHERE hotelLocationI = '$locationI '  AND hotelLocationJ = '$locationJ'";
      mysqli_query($con, $updatequery) or die("Luxury rooms not updated");
     }else{//updates the inventory of standard rooms
      
       $updatequery = "UPDATE `hotel` SET numStandard = '$numStan' WHERE hotelLocationI = '$locationI'  AND  hotelLocationJ = '$locationJ'";
       mysqli_query($con, $updatequery) or die("Standard rooms not updated");
     }
mysqli_query($con, $insertresquery) or die("4: Insert reservation query failed"); //error code 4  insertquery failed
        echo "success";
       //unset( $_SESSION["ErrorTConfirm"]);
       //$_SESSION["ErrorCTConfirm"] = "Success";
    header("Location: myReservations.php");
    exit;
    }
    else{
      header("Location: hotelLog.php");
     // $_SESSION["ErrorCTConfirm"] = "Please Log in before attempting to make Reservation. Thank You.";
     // header("Location: chainTwoBook.php");
    }
    
}
?>