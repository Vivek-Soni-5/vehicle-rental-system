<?php
$flag = 0;
$failed = 1;
// $agedenied = 0;
if(isset($_POST['register']))
{
$conn = mysqli_connect("localhost","root","","car_rental");
if(!$conn)
{
    die("conection failed !!!".mysqli_connect_error());
}
$username = $_POST['Username'];
$email = $_POST['Email'];
$phone = $_POST['Phone'];
$password = $_POST['Password'];
$driving_licence = $_POST['driving_licence'];
$aadhar = $_POST['aadhar'];
$type = $_POST['type'];
$condition = $_POST['condition'];
$model = $_POST['model'];
$registration_number = $_POST['registration_number'];
if(isset($_POST['register']))
{
    
    $sql_query = "INSERT INTO `owner_signup` (`name`, `email`, `phone`, `password`, `driving_licence`, `aadhar_no`, `type`, `condition`, `model`, `registration_no`, `date`) VALUES ('$username', '$email', '$phone', '$password', '$driving_licence', '$aadhar', '$type', '$condition', '$model', '$registration_number', current_timestamp());";
    $sql_query1 = "SELECT `name`,`password` FROM `owner_signup`";
    $return1 = mysqli_query($conn,$sql_query1);
    $flag=0;
    // if($age<18)
    // {
    //     $agedenied = 1;
    // }
    while ($row = $return1->fetch_assoc()) {

        if($row['name']==$username && $row['password']==$password)
        {
            //echo"<script> alert('user exists!!!')</script>";
            $flag=1;
            break;
        }
    
    }
    if($flag==0)
    {
        $failed = 0;
        mysqli_query($conn,$sql_query);
        //echo"<script> alert('registration successfull!!!')</script>";
    }
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
    <link rel="stylesheet" href="owner_signup.css">
    <title>owner signup</title>
</head>
<body >
    <div class="center">
        <h1>Owner Signup</h1>
        <div class="failed">
                <span>
                <?php
                    if($flag==1)
                    {
                        echo"user exists!!!";
                    }
                    // if($agedenied==1)
                    // {
                    //     echo"Age < 18 yr !!!";
                    // }
                ?>
                </span>
                <p>
                <?php
                    if($failed==0)
                    {
                        echo"registration successfull!!!";
                    }
                ?>
                </p>

            </div>
        <form action="http://localhost/covid/owner_signup.php" method="POST">
         
            <div class="text_field">
                <input type="text" required name="Username">
                <span></span>
                <label>Full Name</label>
            </div>

            <div class="text_field">
                <input type="email" required name="Email">
                <span></span>
                <label>Email</label>
            </div>

            <div class="text_field">
                <input type="text" required name="Phone">
                <span></span>
                <label>Phone</label>
            </div>

            <div class="text_field">
                <input type="password" required name="Password">
                <span></span>
                <label>password</label>
            </div>

            <div class="text_field">
                <input type="text" required name="driving_licence">
                <span></span>
                <label>Driving Licence</label>
            </div>

            <div class="text_field">
                <input type="text" required name="aadhar">
                <span></span>
                <label>Aadhar Number</label>
            </div>

            <div class="selectvehicle">
                <span class="label">TYPE: </span>
                <select name="type" id="">
                    <option value="car">car</option>
                    <option value="bike">bike</option>
                </select>
            </div>

            <div class="selectCondition">
                <span class="label">CONDITION: </span>
                <select name="condition" id="">
                    <option value="very good">very good</option>
                    <option value="good">good</option>
                    <option value="average">average</option>
                </select>
            </div>

            <div class="text_field">
                <input type="text" required name="model">
                <span></span>
                <label>Model/Name</label>
            </div>

            <div class="text_field">
                <input type="text" required name="registration_number">
                <span></span>
                <label>Registration Number</label>
            </div>

            <!-- <div class="pass">forget password?</div> -->
            <input type="submit" name="register" value="register">
            <div class="login">
                Already a member? <a href="owner_login.php">login</a>
            </div>
        </form>
    </div>
</body>
</html>