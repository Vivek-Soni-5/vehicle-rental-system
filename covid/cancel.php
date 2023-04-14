<?php  
$conn = mysqli_connect("localhost","root","","car_rental");
if(!$conn)
{
    die("conection failed !!!".mysqli_connect_error());
}

$vid = $_GET['vid'];

// echo $vid;
$sql_query1 = "DELETE FROM `book` WHERE `book`.`v_id` = '$vid'";
$result1 = mysqli_query($conn,$sql_query1);
$sql_query = "UPDATE `vehicle` SET `booked` = 'no' WHERE `vehicle`.`v_id` = '$vid';";
$result = mysqli_query($conn,$sql_query);

if($result)
{
    echo "<script>alert('cancelled successfully!!!')</script>";
    ?>
    <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/covid/booking_details.php">
    <?php
}
  
mysqli_close($conn);

?>

