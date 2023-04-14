<?php  
$conn = mysqli_connect("localhost","root","","car_rental");
if(!$conn)
{
    die("conection failed !!!".mysqli_connect_error());
}

$vid = $_GET['vid'];


$sql_query2 = "SELECT `booked` FROM `vehicle` WHERE `v_id` = '$vid';";
$result2 = mysqli_query($conn,$sql_query2);
while ($row = $result2->fetch_assoc()) {
    $booked = $row['booked'];
}


// echo $vid;
if($booked == 'yes')
{
    echo "<script>alert('Vehicle cannot be removed because it is booked already !!!')</script>";
    ?>
    <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/covid/added_vehicles.php">
    <?php
}
else
{
    $sql_query1 = "DELETE FROM `vehicle` WHERE `vehicle`.`v_id` = '$vid'";
    $result1 = mysqli_query($conn,$sql_query1);
    $sql_query = "DELETE FROM `book` WHERE `book`.`v_id` = '$vid'";
    // $result = mysqli_query($conn,$sql_query);
    echo "<script>alert('Deleted successfully!!!')</script>";
    ?>
    <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/covid/added_vehicles.php">
    <?php
}
  
mysqli_close($conn);

?>

