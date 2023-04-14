<?php  
$conn = mysqli_connect("localhost","root","","car_rental");
if(!$conn)
{
    die("conection failed !!!".mysqli_connect_error());
}

// session_start();
// $city = $_SESSION['city'];
// $type = $_SESSION['type'];
// $cust_name = $_SESSION['Name'];
// $c_id = $_SESSION['c_id'];
// $startdate = $_SESSION['startdate'];
// $enddate = $_SESSION['enddate'];
// $model = $_SESSION['model_name'];
// $reg = $_SESSION['reg'];
// $base_price = $_SESSION['base_price'];
// $priceperKM = $_SESSION['priceperKM'];

$vid = $_GET['vid'];
$model = $_GET['model_name'];
$reg = $_GET['reg'];
$baseprice = $_GET['base_price'];
$priceperKM = $_GET['price_km'];

session_start();
$email = $_SESSION['email'];
// echo $email;
$city = $_SESSION['city'];
$type = $_SESSION['type'];
$cust_name = $_SESSION['Name'];
$c_id = $_SESSION['c_id'];
$startdate = $_SESSION['startdate'];
$enddate = $_SESSION['enddate'];

// session_start();
// $_SESSION['model_name'] = $model;
// $_SESSION['reg'] = $reg;
// $_SESSION['base_price'] = $baseprice;
// $_SESSION['priceperKM'] = $priceperKM;

// echo $vid;
$sql_query1 = "INSERT INTO `book` (`customer_name`, `c_id`, `v_id`, `city`, `type`, `Startdate`, `Enddate`) VALUES ('$cust_name', '$c_id', '$vid', '$city', '$type', '$startdate', '$enddate');";
$result1 = mysqli_query($conn,$sql_query1);
$sql_query = "UPDATE `vehicle` SET `booked` = 'yes' WHERE `vehicle`.`v_id` = '$vid';";
$result = mysqli_query($conn,$sql_query);



if($result)
{
    echo "<script>alert('booked successfully!!! and Confirmation msg has been sent to your Registered email id')</script>";
    
    ?>
    <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/covid/send_email.php">
    <?php
}
  
mysqli_close($conn);

?>

