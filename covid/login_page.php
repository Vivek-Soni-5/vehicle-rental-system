<?php
$flag=0;
$failed = 1;
if(isset($_POST['save']))
{   
$conn = mysqli_connect("localhost","root","","car_rental");
if(!$conn)
{
    die("conection failed !!!".mysqli_connect_error());
}
$username1 = $_POST['Username'];
$password1 = $_POST['Password'];
session_start();
$_SESSION['Name'] = $username1;
if(isset($_POST['save']))
{
    $sql_query1 = "SELECT `c_id`,`customer_name`, `password`, `email` FROM `customer_signup` ;";
    $return1 = mysqli_query($conn,$sql_query1);
    
    while ($row = $return1->fetch_assoc()) {

        if($row['customer_name']==$username1 && $row['password']==$password1)
        {
            $c_id = $row['c_id'];
            $email = $row['email'];
            session_start();
            $_SESSION['c_id'] = $c_id;
            $_SESSION['email'] = $email;
            $flag=1;
            echo"login successfull!!!";
            header('location: /covid/customer_new.php');
            break;
        }
    
    }
    if($flag==0)
    {
        $failed = 0;
        //echo"<script> alert('user not exists!!!! sign up first')</script>";
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
    <link rel="stylesheet" href="login_page.css">
    <title>Document</title>
</head>

<body style="background-image : url('login_bg.webp'); background-size : contain; background-repeat : no-repeat;">
    <!-- <img src="ferrai.webp" alt="eror"> -->

    <div class="center">
        <h1>Customer Login</h1>
        <div class="failed">
            <span>
                <?php
                    if($failed==0)
                    {
                        echo"user not exists!!!! sign up first";
                        $failed = 1;
                    }
                ?>
            </span>

        </div>
        <form action="http://localhost/covid/login_page.php" method="POST">

            <div class="text_field">
                <input type="text" required name="Username">
                <span></span>
                <label>User</label>
            </div>

            <div class="text_field">
                <input type="password" required name="Password">
                <span></span>
                <label>password</label>
            </div>
            <div class="pass">forget password?</div>
            <input type="submit" name="save" value="login">

            <div class="signup">
                <!-- Not a member?<input type="submit" name="signup1" value="sign up"> -->
                Not a member?
                <a href="signup_new.php" name="signup1">signup</a>
            </div>
        </form>
    </div>
    <div class="img">
        <img src="http://localhost/covid/logo_final6.jpg" alt="not found"
            style="height: 80px;width: 80px;border-radius: 25px;">
    </div>
</body>

</html>