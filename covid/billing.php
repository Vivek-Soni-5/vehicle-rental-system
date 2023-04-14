<?php  
$conn = mysqli_connect("localhost","root","","car_rental");
if(!$conn)
{
    die("conection failed !!!".mysqli_connect_error());
}
$flag = 0;
$flag1 = 1;
$failed = 0;
$discounted = 0;
$valid_once = 0;
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
$city = $_SESSION['city'];
$type = $_SESSION['type'];
$cust_name = $_SESSION['Name'];
$c_id = $_SESSION['c_id'];
$startdate = $_SESSION['startdate'];
$enddate = $_SESSION['enddate'];
// session_start();
$_SESSION['v_id'] = $vid;
$_SESSION['model_name'] = $model;
$_SESSION['reg'] = $reg;
$_SESSION['base_price'] = $baseprice;
$_SESSION['priceperKM'] = $priceperKM;

$timestampstart = strtotime($startdate);
$timestampend = strtotime($enddate);
$sec = $timestampend-$timestampstart;
$days = (int)($sec/86400);
$subtotal = $days*$priceperKM+$baseprice;
$tax = $subtotal*0.05;
$pre_total = $tax+$subtotal;
$total = $tax+$subtotal;


if(isset($_POST['apply']))
{

    $coupon = $_POST['coupon'];
    $_SESSION['coupon'] = $coupon;
    $sql_query = "SELECT `discount_name`,`discount_percent` FROM `discount_list`;";
    $result = mysqli_query($conn,$sql_query);
    while ($row = $result->fetch_assoc()) {
        if(($row['discount_name'])==$coupon && $coupon != "NEWUSER50")
        {
            $flag = 1;
            if((($row['discount_percent'])*0.01*$pre_total)<500)
            {
                $total = $pre_total-($row['discount_percent'])*0.01*$pre_total;
                $discounted = ($row['discount_percent'])*0.01*$pre_total;
            }
            else
            {
                $total = $pre_total-500;
                $discounted = 500;
            }
        }
        else if(($row['discount_name'])==$coupon && $coupon == "NEWUSER50")
        {
            $sql_query1 = "SELECT `discount_name`,`customer_id` FROM `customer_discount`;";
            $result1 = mysqli_query($conn,$sql_query1);
            while ($row = $result1->fetch_assoc()){
                if(($row['customer_id'])==$c_id )
                {
                    $flag1 = 0;
                    $valid_once = 1;
                }
            }
            if($flag1 != 0)
            {
                $flag = 1;
                if((0.5*$pre_total)<500)
                {
                    $total = $pre_total-0.5*$pre_total;
                    $discounted = 0.5*$pre_total;
                }
                else
                {
                    $total = $pre_total-500;
                    $discounted = 500;
                }
            }
        }
    }
    if($flag == 0)
    {
        $failed = 1;
    }


    //  $coupon = $_POST['coupon'];
    // if($coupon == "NEWUSER50")
    // {
    //     if((0.5*$pre_total)<500)
    //     {
    //         $total = $pre_total-0.5*$pre_total;
    //     }
    //     else
    //     {
    //         $total = $pre_total-500;
    //     }
    //     $flag = 1;
    // }
    // else
    // {
    //     $flag1 = 2;
    // }
}
$_SESSION['total'] = $total; 
$_SESSION['flag'] = $flag;

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
    <!-- <title>Bootstrap Example</title> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="billing1.css">
    <title>Document</title>
</head>

<body
    style="background-image : url('login_bg.webp'); background-size : contain; background-repeat : no-repeat;  backdrop-filter: blur(5px);overflow:scroll;">

    <div class="marginn" style="height:30px;"></div>

    <!-- old billing -->
    <div class="center">
        <h1><b style="font-size: xx-large;">Billing</b></h1>
        <p><?php echo "<b>Time: </b>".date("h:i:s A")?></p>
        <p><?php echo "<b>Date: </b>".date("d/m/y")?></p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Model Name</th>
                    <th scope="col">Registration No</th>
                    <th scope="col">start Date</th>
                    <th scope="col">end Date</th>
                    <th scope="col">no of days</th>
                    <th scope="col">Base Price</th>
                    <th scope="col">Price/days</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $model; ?></td>
                    <td><?php echo $reg; ?></td>
                    <td><?php echo (new DateTime($startdate))->format('Y-m-d H:i:s'); ?></td>
                    <td><?php echo (new DateTime($enddate))->format('Y-m-d H:i:s'); ?></td>
                    <td><?php echo $days; ?></td>
                    <td><?php echo "₹".$baseprice; ?></td>
                    <td><?php echo "₹".$priceperKM; ?></td>
                    <td><?php echo "<font color=red size='4pt'><b>₹$subtotal</b></font>"; ?></td>
                </tr>
            </tbody>
        </table>
        <div class="subtotal">Sub Total : <span><?php echo "₹".$subtotal; ?></span></div>
        <div class="tax">Tax(5%) : <span><?php echo "₹".$tax; ?></span></div>
        <?php
            if($flag == 0)
            {
        ?>
        <div class="total">Gross Total : <span><?php echo "₹".$pre_total; ?></span></div>
        <?php
            }
            else if($flag == 1)
            {
        ?>
        <div class="total">Gross Total : <span
                style="text-decoration: line-through;"><?php echo "₹".$pre_total; ?></span><span><?php echo " ₹".$total; ?></span>
            <div class="para" style="color:green;">You save ₹<?php echo $discounted ?> on this booking</div>
        </div>
        <?php
            }
            if($valid_once == 1)
            {
        ?>
        <div class="total">
            <div class="para" style="color:red;">Valid for New Users only</div>
        </div>
        <?php
            }
        ?>
        <?php 
            if($failed == 1)
            {
        ?>
        <div class="total">
            <div class="para" style="color:red;">Coupon doesn't exists!!!</div>
        </div>
        <?php
            }
        ?>


        <div class="container h-screen flex justify-center items-center" style="position: relative;height: auto;">
            <div class="relative">
                <form method="POST">
                    <input type="text" class="h-14 w-96 pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
                        name="coupon" required placeholder="COUPON CODE">
                    <div class="absolute top-2 right-2">

                        <input type="submit" name="apply" value="Apply"
                            style="height:35px;width:65px;position: relative;left: -41px;">

                    </div>
                </form>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm">
                <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">50% OFF CODE : NEWUSER50</h5>
                <p class="text-gray-700 text-base mb-4">
                    New User Only<br>
                    Maximum discount upto ₹500 on this Rent
                    TERMS AND CONDITIONS APPLY
                </p>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm">
                <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">25% OFF CODE : FREE25</h5>
                <p class="text-gray-700 text-base mb-4">
                    Maximum discount upto ₹500 on this Rent
                    TERMS AND CONDITIONS APPLY
                </p>
            </div>
        </div>


        <div class="btn">
            <a
                href="book.php?vid=<?php echo $vid; ?>&model_name=<?php echo $model; ?>&reg=<?php echo $reg; ?>&base_price=<?php echo $baseprice; ?>&price_km=<?php echo $priceperKM; ?>"><input
                    type="submit" name="book" value="book">
        </div>

    </div>
    <div class="marginn" style="height:30px;"></div>
        

</body>

</html>