 <?php  
$conn = mysqli_connect("localhost","root","","car_rental");
if(!$conn)
{
    die("conection failed !!!".mysqli_connect_error());
}

session_start();
$id = $_SESSION['c_id'];

$sql_query = "SELECT `book`.`v_id`,`book`.`city`,`book`.`type`,`book`.`Startdate`,`book`.`Enddate`,`vehicle`.`model_name`,`vehicle`.`model_year`,`vehicle`.`registration_no` FROM `book`,`vehicle` WHERE `book`.`c_id` = '$id' and `book`.`v_id`=`vehicle`.`v_id` and `vehicle`.`booked`='yes';";
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

    <link rel="stylesheet" href="booking_details1.css">
    <title>Document</title>
</head>

<body style="background-image : url('login_bg.webp'); background-size : contain; background-repeat : no-repeat;  backdrop-filter: blur(5px);">
    <div class="center">
        <h1>Booking Details</h1>

        <table class="table">
            <thead>
                <tr>
                    <!-- <th scope="col">sno</th>
                    <th scope="col">Name</th> -->
                    <th scope="col">City</th>
                    <th scope="col">Type</th>
                    <th scope="col">Model</th>
                    <th scope="col">Model Year</th>
                    <th scope="col">Registration No</th>
                    <th scope="col">StartDate</th>
                    <th scope="col">EndDate</th>
                    <th scope="col">Cancel</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                
                <?php
                    while($row = mysqli_fetch_assoc($result))
                    {
                ?>  
                    <td><?php echo $row['city']; ?></td>
                    <td><?php echo $row['type']; ?></td>
                    <td><?php echo $row['model_name']; ?></td>
                    <td><?php echo $row['model_year']; ?></td>
                    <td><?php echo $row['registration_no']; ?></td>
                    <td><?php echo (new DateTime($row['Startdate']))->format('Y-m-d H:i:s'); ?></td>
                    <td><?php echo (new DateTime($row['Enddate']))->format('Y-m-d H:i:s'); ?></td>
                    <td><a href="cancel.php?vid=<?php echo $row['v_id']; ?>" ><input type="submit" name="cancel" value="cancel"></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>

    </div>

</body>

</html>