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
    <link rel="stylesheet" type="text/css" href="Search.css">
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
                    <li><a href="Map.php">Map</a></li>
                    <li ><a href="Reservations.php">View Reservations</a></li>
                    <li id = "active"><a href="Search.php">Search for Hotel</a><li>
                    
                </ul>
                <!-- <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form> -->
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

    <div class = "search">
        <h1 id = "head">Hotel Search</h1>   
        <form action = "" method ="GET" name = "" class="navbar-form navbar-left">
            <div class="form-group">
                <input type="text" name="k" value="<?php echo isset($_GET['k']) ? $_GET['k'] : '' ?>" class="form-control" placeholder="Search"/>

                <!-- <input type="text" name="k" > -->
            </div>
            <button type="submit" name="" value="Search" class="btn btn-default">Submit</button>
      
            <label for="sort">Sort results by  </label>

            <select name="sort" id = "sort">
                <option <?php if ($_GET['sort'] == 'none') { ?>selected="true" <?php }; ?>value="none">select</option>
                <option <?php if ($_GET['sort'] == 'hotelName') { ?>selected="true" <?php }; ?>value="hotelName">hotel name</option>
                <option <?php if ($_GET['sort'] == 'increasing') { ?>selected="true" <?php }; ?>value="increasing">price increasing</option>
                <option <?php if ($_GET['sort'] == 'decreasing') { ?>selected="true" <?php }; ?>value="decreasing">price decreasing</option>
            </select>
            <input type="submit" name="submit" value="Enter" />
        </form>
     
    </div>    
    <?php

       
        if ((isset($_GET['k']) && $_GET['k'] != '') || (isset($_GET['submit']) && isset($_GET['k']) && $_GET['k'] != '')){
            
            $selected_val = $_GET['sort'];  // Storing Selected Value In Variable

            if($selected_val == "hotelName") $orderBy = "ORDER BY hotelChain ASC;";
            else if($selected_val == "increasing") $orderBy = "ORDER BY priceStandard ASC;";
            else if($selected_val == "decreasing") $orderBy = "ORDER BY priceStandard DESC;";
            else{
                $orderBy = ";";
            }


            

            $k = trim($_GET['k']);
            $keywords = explode(' ', $k);

            $query_string = "SELECT * FROM hotel WHERE ";
            $display_words = "";

            //print_r($keywords);
            foreach($keywords as $word){
                $query_string .= "keywords LIKE '%" . $word . "%'  OR";
                $display_words .= $word . " "; 
            }
            $query_string = substr($query_string, 0, strlen($query_string)-3) . $orderBy;

            $query = mysqli_query($con, $query_string);
            $result_count = mysqli_num_rows($query);

            if($result_count > 0){
                echo "<div id = 'description'><b><u>" . $result_count . "</u></b> results found </br>";
                echo "Your search for: <i> " . $display_words . "</i></div>";

                echo '<table class = "results">';
                while($row = mysqli_fetch_assoc($query)){
                    echo '<tr>
                            <td id = "large">' . $row['hotelChain'] . '</td>
                            <td>Location: ' . $row['hotelLocationI'] . ",". $row['hotelLocationJ'] . '</td></tr>
                            <tr><td>Amount Standard Rooms Available: ' . $row['numStandard'] . '</td>
                            <td>Price per night standard room: $' . $row['priceStandard'] . '</td>
                            <td>Amount Luxury Rooms Available: ' . $row['numLuxury'] . '</td>
                            <td>Price per night luxury room: $' . $row['priceLuxury'] . '</td></tr>';
                            if($hotelChain == 'Marriot'){
                                $hotelURL = "https://venus.cs.qc.cuny.edu/~bast8620/chainOneHotels.php";
                            }else if($hotelChain == "Westin"){
                                $hotelURL = "https://venus.cs.qc.cuny.edu/~bast8620/chainTwoHotels.php";
                            }else{
                               $hotelURL = "https://venus.cs.qc.cuny.edu/~bast8620/chainThreeHotels.php";
                            }
                           ' <tr><td><a href ="' . $hotelURL . '"<button>Book a room</button></td>
                            <td><button>Cancel Reservation</button></td><tr><td id = "space"></td>
                    </tr>';
                }
                echo '</table>';
            }
            else{
                echo 'No results found';
            }


            //echo $query_string;
        }
        else{
            echo '';
        }
    ?>


</body>
<script src="https://code.jquery.com/jquery-3.2.1.js"
        integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>
<script src=" https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">


</script>
<style type = "text/css">
         
         .results tr td{
            height: 30px;
            color: black;
            padding-left: 60px;
        } 


        #description{
            margin-left: 520px;
            margin-top: 0px;
        }

        #head{
            color: #40e4b3;
        }

        .search{
            color: black;
            width: 70%;
            height: 20%;
            margin-left: 520px;
            margin-top: 70px;
            margin-bottom: 0px;
               
        }

        #space{
            height: 30px;
        }

        #large{
            color: red;
            font-weight: bold;
            font-size: 40px;
        }
        .results{
            width: 100%;
            background-color: rgba(220, 220, 220, 0.88);
        }

        #active{
	        background-color: #be617d;
        }
        


    </style>


</html>