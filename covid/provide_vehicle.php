<?php
$flag = 0;
session_start();
$owner_id = $_SESSION['owner_id'];
// $c_id = $_SESSION['c_id'];
if(isset($_POST['add']))
{
$conn = mysqli_connect("localhost","root","","car_rental");
if(!$conn)
{
    die("conection failed !!!".mysqli_connect_error());
}
$city = $_POST['city'];
$type = $_POST['type'];
$model_name = $_POST['model_name'];
$model_year = $_POST['model_year'];
$registration_no = $_POST['registration_no'];
$base_price = $_POST['base_price'];
$priceperKM = $_POST['priceperKM'];

if(isset($_POST['add']))
{
    
    $sql_query = "INSERT INTO `vehicle` (`owner_id`, `city`, `type`, `model_name`, `model_year`, `registration_no`, `DOP`,`base_price`,`priceperKM`) VALUES ('$owner_id', '$city', '$type', '$model_name', '$model_year', '$registration_no',current_timestamp(),'$base_price','$priceperKM');";
    mysqli_query($conn,$sql_query);
    $flag =1;
    //echo"<script> alert('booked successfull!!!')</script>";
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
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="provide_vehicle1.css">
    <title>Customer main page</title>
</head>

<body style="background-image : url('login_bg.webp'); background-size : contain; background-repeat : no-repeat;  backdrop-filter: blur(5px);">

    <div class="center">
        <h1>Provide a Vehicle</h1>
        <div class="failed">
            <span>
                <?php
                    if($flag==1)
                    {
                        echo"Added successfully!!!";
                    }
                ?>
            </span>

        </div>
        <form action="http://localhost/covid/provide_vehicle.php" method="POST">

            <!-- <div class="selectlocation">
                <span class="label">CITY: </span>
                <select name="city" id="">
                    <option value="Bangalore">Bangalore</option>
                    <option value="Chennai">Chennai</option>
                    <option value="Mumbai">Mumbai</option>
                    <option value="Hyderabad">Hyderabad</option>
                </select>
            </div> -->

            <div class="flex justify-center">
            <span class="label" style = "justify-content: center;display: flex;font-size: large;font-weight: bold;" >CITY </span>
                <div class="mb-3 xl:w-96">
                    <select class="form-select appearance-none
                                    block
                                    w-full
                                    px-3
                                    py-1.5
                                    text-base
                                    font-normal
                                    text-gray-700
                                     bg-white bg-clip-padding bg-no-repeat
                                    border border-solid border-gray-300
                                    rounded
                                    transition
                                    ease-in-out
                                    m-0
                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example" name="city">
                        <option value="Bangalore">Bangalore</option>
                        <option value="Chennai">Chennai</option>
                        <option value="Mumbai">Mumbai</option>
                        <option value="Hyderabad">Hyderabad</option>
                    </select>
                </div>
            </div>

            <!-- <div class="selectvehicle">
                <span class="label">TYPE: </span>
                <select name="type" id="">
                    <option value="car">car</option>
                    <option value="bike">bike</option>
                    <option value="Cycle">Cycle</option>
                </select>
            </div> -->

            <div class="flex justify-center">
            <span class="label" style = "justify-content: center;display: flex;font-size: large;font-weight: bold;" >Vehicle Type </span>
                <div class="mb-3 xl:w-96">
                    <select class="form-select appearance-none
                                    block
                                    w-full
                                    px-3
                                    py-1.5
                                    text-base
                                    font-normal
                                    text-gray-700
                                     bg-white bg-clip-padding bg-no-repeat
                                    border border-solid border-gray-300
                                    rounded
                                    transition
                                    ease-in-out
                                    m-0
                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example" name="type">
                        <option value="car">car</option>
                        <option value="bike">bike</option>
                        <option value="Cycle">Cycle</option>
                    </select>
                </div>
            </div>
            
            <div class="text_field">
                <input type="text"  required name="model_name">
                <span></span>
                <label>Model Name</label>
            </div>

            <div class="text_field">
                <input type="text"  required name="model_year">
                <span></span>
                <label>Model Year</label>
            </div>

            <div class="text_field">
                <input type="text"  required name="registration_no">
                <span></span>
                <label>Registration Number</label>
            </div>

            <div class="text_field">
                <input type="text"  required name="base_price">
                <span></span>
                <label>Base Price</label>
            </div>

            <div class="text_field">
                <input type="text"  required name="priceperKM">
                <span></span>
                <label>DayWise Price</label>
            </div>
            
            <input type="submit" name="add" value="ADD">
    </div>
    </form>
    </div>
</body>

</html>