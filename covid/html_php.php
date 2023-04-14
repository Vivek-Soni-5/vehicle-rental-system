<?php
$booked = false;
session_start();
$Name = $_SESSION['Name'];
$sno = $_SESSION['sno'];
if(isset($_POST['city']))
{
$conn = mysqli_connect("localhost","root","","car_rental");
if(!$conn)
{
    die("conection failed !!!".mysqli_connect_error());
}
$city = $_POST['city'];
$type = $_POST['type'];
$Startdate = $_POST['Startdate'];
$Enddate = $_POST['Enddate'];




if(isset($_POST['book']))
{
    
    $sql_query = "INSERT INTO `rent_vehicle_customer` (`Name_id`,`city`,`name`, `type`, `Startdate`, `Enddate`) VALUES ('$sno','$city','$Name','$type','$Startdate','$Enddate');";
    mysqli_query($conn,$sql_query);
    // echo"<script> alert('booked successfull!!!')</script>";
    $booked = TRUE;
    mysqli_close($conn);
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="customer.css">
    <title>Customer main page</title>
</head>

<body>

    <div class="CSMS">
        <h1>Vehicle Rental System</h1>
        
    </div>

    <div class="flex">
        <a class="home" href="">Home</a>
        <a class="contact" href="C:\xampp\htdocs\covid\contact1.html">Contact</a>
        <a class="AboutUs" href="">AboutUs</a>
        <a class="Blog" href="">Blog</a>
    </div>
    
    <div class="img">
        <!-- <img src="http://localhost/covid/logo_carRental.jpg" alt="not found" width="250px" height="170px"> -->
    </div>


    <div class="center">
        <h1>Rent a Vehicle</h1>
        <form action="http://localhost/covid/html_php.php" method="POST">

            <div class="selectlocation">
                <span class="label">CITY: </span>
                <select name="city" id="">
                    <option value="Bangalore" default>Bangalore</option>
                    <option value="Chennai">Chennai</option>
                </select>
            </div>
            <div class="selectvehicle">
                <span class="label">TYPE: </span>
                <select name="type" id="">
                    <option value="car" default>car</option>
                    <option value="bike">bike</option>
                </select>
            </div>
            <div class="startdate">
                <span class="label">Choose Start Date: </span>
                <input type="datetime-local" id="meeting-time" name="Startdate" value="2018-06-12T19:30"
                min="2020-06-07T00:00" max="2023-06-14T00:00">
            </div>
            <div class="enddate">
                <span class="label">Choose End Date: </span>
                <input type="datetime-local" id="meeting-time" name="Enddate" value="2018-06-12T19:30"
                min="2020-06-07T00:00" max="2023-06-14T00:00">
            </div>
            <div class="amount">
                <span class="label"></span>
                <span class="show"> <?php
                if($booked == TRUE)
                {
                    echo"BOOKED SUCCESSFULLY!!!";
                    $booked = false;
                }
                ?></span>
            </div>
            <input type="submit" name="book" value="Book">
            </div>
        </form>
    </div>
</body>


</html>

