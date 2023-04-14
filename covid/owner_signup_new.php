<?php
$flag = 0;
$failed  = 1;
$agedenied = 0;
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
$alt_phone = $_POST['alt_phone'];
$password = $_POST['password'];
$address = $_POST['address'];
$age = $_POST['age'];
$aadhaar = $_POST['aadhaar'];

if(isset($_POST['register']))
{
    
    
    $sql_query = "INSERT INTO `owner_signup` (`owner_name`, `address`, `email`, `password`, `date`,`age`,`aadhaar_no`) VALUES ('$username', '$address', '$email','$password', current_timestamp(),'$age','$aadhaar');";
    $sql_query1 = "SELECT `own_id`,`owner_name`, `password` FROM `owner_signup`";
    $sql_query3 = "SELECT `own_id`,`owner_name`, `password` FROM `owner_signup`";
    $return1 = mysqli_query($conn,$sql_query1);
    $flag=0;
    if($age<18)
    {
        $agedenied = 1;
    }
    while ($row = $return1->fetch_assoc()) {

        if($row['owner_name']==$username && $row['password']==$password)
        {
            // echo"<script> alert('user exists!!!')</script>";
            $flag=1;
            break;
        }
    
    }
    if($flag==0 && $agedenied==0)
    {
        $failed = 0;
        $return = mysqli_query($conn,$sql_query);
        $return3 = mysqli_query($conn,$sql_query3);
        while ($row = $return3->fetch_assoc()) {
            if($row['owner_name']==$username && $row['password']==$password)
            {
                $own_id = $row['own_id'];
            }
        }
        $sql_query2 = "INSERT INTO `own_ph_no` (`owner_id`,`phone`) VALUES ('$own_id','$phone')";
        $return2 = mysqli_query($conn,$sql_query2);
        $sql_query4 = "INSERT INTO `own_ph_no` (`owner_id`,`phone`) VALUES ('$own_id','$alt_phone')";
        if($alt_phone != NULL)
        {
            mysqli_query($conn,$sql_query4);
        }
        
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
    <link rel="stylesheet" href="signup_new.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>


    <title>owner signup</title>
</head>

<body style="background-image : url('login_bg.webp'); background-size : contain; background-repeat : no-repeat;">
    <!-- <div class="center"> -->
    <form action="http://localhost/covid/owner_signup_new.php" method="POST">

        <!-- component -->
        <div class="bg-grey-lighter min-h-screen flex flex-col">
            <div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2" style="left: 250px;
                 top: 50px;
                 position: absolute;">
                <div class="bg-white px-6 py-8 rounded shadow-md text-black w-full">
                    <h1 class="mb-8 text-3xl text-center">Owner Sign up</h1>
                    <div class="failed" style="left: 107px;position: relative;font-weight: bolder;color: red;font-size: large;">
                        <span>
                            <?php
                                if($flag==1)
                                {
                                    echo"User Exists!!!";
                                }
                                if($agedenied==1)
                                {
                                    echo"Age < 18 yr !!!";
                                }
                            ?>
                        </span>
                        <p style = "color: green;position: relative;left: -50px;font-size: large;" >
                            <?php
                                if($failed==0)
                                {
                                     echo"Registration successfull!!!";
                                }
                            ?>
                        </p>

                    </div>
                    <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" required name="Username"
                        placeholder="Full Name" />

                    <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" required name="Email"
                        placeholder="Email" />

                    <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" required name="Phone"
                        placeholder="Phone" />

                    <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" name="alt_phone"
                        placeholder="Alternate Phone (Optional)" />

                    <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" required name="address"
                        placeholder="Address" />

                    <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" required name="aadhaar"
                        placeholder="Aadhaar Number" />

                    <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" required
                        name="age" placeholder="Age" />

                    <input type="password" required class="block border border-grey-light w-full p-3 rounded mb-4"
                        name="password" placeholder="Password" />

                    <button type="submit"
                        class="w-full text-center py-3 rounded bg-green text-white hover:bg-green-dark focus:outline-none my-1"
                        style="color: white; background: green;" name="register" value="register">Create
                        Account</button>

                    <!-- <div class="text-center text-sm text-grey-dark mt-4">
                        By signing up, you agree to the
                        <a class="no-underline border-b border-grey-dark text-grey-dark" href="#">
                            Terms of Service
                        </a> and
                        <a class="no-underline border-b border-grey-dark text-grey-dark" href="#">
                            Privacy Policy
                        </a>
                    </div> -->
                </div>

                <div class="text-grey-dark mt-6" style="color: white;">
                    Already have an account?
                    <a class="no-underline border-b border-blue text-blue" href="owner_login.php">
                        Log in
                    </a>
                </div>
            </div>
        </div>
    </form>
    <!-- </div> -->
</body>

</html>