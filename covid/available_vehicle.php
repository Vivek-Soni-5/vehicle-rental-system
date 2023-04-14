<?php  
$conn = mysqli_connect("localhost","root","","car_rental");
if(!$conn)
{
    die("conection failed !!!".mysqli_connect_error());
}

session_start();
$email = $_SESSION['email'];
$city = $_SESSION['city'];
$type = $_SESSION['type'];
$cust_name = $_SESSION['Name'];
$c_id = $_SESSION['c_id'];
$startdate = $_SESSION['startdate'];
$enddate = $_SESSION['enddate'];

$sql_query = "SELECT * FROM `vehicle` WHERE `city` = '$city' and `type` = '$type' and `booked` = 'no' ";
$result = mysqli_query($conn,$sql_query);
  
mysqli_close($conn);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="available_vehicle2.css">
    <title>Document</title>
</head>

<body style="background-image : url('login_bg.webp'); background-size : contain; background-repeat : no-repeat;  backdrop-filter: blur(5px);">
    <div class="center">
        <h1>Available Vehicles</h1>

        <table class="table">
            <thead>
                <tr>
                    <!-- <th scope="col">sno</th>
                    <th scope="col">Name</th> -->
                    <th scope="col">City</th>
                    <th scope="col">Type</th>
                    <th scope="col">Model Name</th>
                    <th scope="col">Model Year</th>
                    <th scope="col">Registration No</th>
                    <th scope="col">Added Date</th>
                    <th scope="col">Base Price</th>
                    <th scope="col">Price/Day</th>
                    <th scope="col">Book</th>
                </tr>
            </thead>
            <tbody>
                <tr>

                    <?php
                    while($row = mysqli_fetch_assoc($result))
                    {
                        // $v_id = $row['v_id'];
                        
                ?>
                    <!-- <th scope="row">1</th> -->
                    <td><?php echo $row['city']; ?></td>
                    <td><?php echo $row['type']; ?></td>
                    <td><?php echo $row['model_name']; ?></td>
                    <td><?php echo $row['model_year']; ?></td>
                    <td><?php echo $row['registration_no']; ?></td>
                    <td><?php echo (new DateTime($row['DOP']))->format('Y-m-d H:i:s'); ?></td>
                    <td><?php echo "₹".$row['base_price']; ?></td>
                    <td><?php echo "₹".$row['priceperKM']; ?></td>
                    <td><a href="billing.php?vid=<?php echo $row['v_id']; ?>&model_name=<?php echo $row['model_name']; ?>&reg=<?php echo $row['registration_no']; ?>&base_price=<?php echo $row['base_price']; ?>&price_km=<?php echo $row['priceperKM']; ?>" ><input type="submit" name="book" value="bill"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    </div>

</body>

</html>