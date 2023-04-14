<?php  
$count = 0 ;
$conn = mysqli_connect("localhost","root","","car_rental");
if(!$conn)
{
    die("conection failed !!!".mysqli_connect_error());
}

session_start();
$id = $_SESSION['owner_id'];

$sql_query = "SELECT * FROM `vehicle` WHERE `owner_id` = '$id'";
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

    <!-- <link rel="stylesheet" href="added_vehicles1.css"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Document</title>
</head>

<body
    style="background-image : url('login_bg.webp'); background-size : contain; background-repeat : no-repeat;  backdrop-filter: blur(5px);">
   
    <!-- table -->
    <!-- <div class="center">
        <h1>Vehicles Details</h1>

        <table class="table">
            <thead>
                <tr> -->
                    <!-- <th scope="col">sno</th>
                    <th scope="col">Name</th> -->
                    <!-- <th scope="col">City</th>
                    <th scope="col">Type</th>
                    <th scope="col">Model Name</th>
                    <th scope="col">Model Year</th>
                    <th scope="col">Registration No</th>
                    <th scope="col">Added Date</th>
                    <th scope="col">Base Price</th>
                    <th scope="col">Price/Day</th>
                    <th scope="col">delete</th>
                </tr>
            </thead>
            <tbody>
                <tr> -->

                    <?php
                    //while($row = mysqli_fetch_assoc($result))
                    //{
                ?>
                    <!-- <th scope="row">1</th> -->
                    <!-- <td><?php //echo $row['city']; ?></td> -->
                    <!-- <td><?php //echo $row['type']; ?></td> -->
                    <!-- <td><?php //echo $row['model_name']; ?></td> -->
                    <!-- <td><?php //echo $row['model_year']; ?></td> -->
                    <!-- <td><?php //echo $row['registration_no']; ?></td> -->
                    <!-- <td><?php //echo (new DateTime($row['DOP']))->format('Y-m-d H:i:s'); ?></td> -->
                    <!-- <td><?php// echo "₹".$row['base_price']; ?></td> -->
                    <!-- <td><?php //echo "₹".$row['priceperKM']; ?></td> -->
                    <!-- <td><a href="remove_provided_vehicle.php?vid=<?php //echo $row['v_id']; ?>"><input type="submit"
                                name="cancel" value="Remove"></td> -->
                </tr>
                <?php
                    //}
                ?>
            <!-- </tbody>
        </table>

    </div> -->


 <!-- navigation bar -->
<header class="text-gray-600 body-font" style="color:blue; background-color:red;height: 70px;">
        <div>
            <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center" style = "height: 0px;display: flex;align-content: center;align-items: flex-start;flex-direction: row;">
                <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                    <img src="http://localhost/covid/logo_grey.jpg" alt="not found"
                        style="height: 40px;width: 40px;border-radius: 17px;">
                    <span class="ml-3 text-xl">Vehicle Rental System</span>
                </a>
                <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                    <a class="mr-5 hover:text-gray-900" href="\covid\owner_new.php" style="color:white;">Home</a>
                    <a class="mr-5 hover:text-gray-900" href="\covid\contact1.html" style="color:white;">Contact</a>
                    <a class="mr-5 hover:text-gray-900" href="\covid\aboutus.php" style="color:white;">AboutUs</a>
                    <a class="mr-5 hover:text-gray-900" href="\covid\blog.php" style="color:white;">Blog</a>
                </nav>
            </div>
        </div>
</header>




<!-- body -->
<?php

        while ($row = $result->fetch_assoc()) {
        ?>

        <?php
        if($count%3==0)
        {
        ?>

            <div class="flex"
            style="display:flex; flex-direction:row;margin: 50px 50px 50px 50px;justify-content: space-evenly;">

        <?php
        }
        ?>
        <div class="flex justify-center">
            <div class="rounded-lg shadow-lg bg-white max-w-sm">
        <?php
        if(($row['model_name']) == "NANO")
        {
        ?>
                <a href="#!">
                    <img class="rounded-t-lg" src="http://localhost/covid/nano1.jpg" alt="" />
                </a>
                <?php
        }
                
        elseif(($row['model_name']) == "ALTO")
        {
    ?>
                <a href="#!">
                    <img class="rounded-t-lg" src="http://localhost/covid/alto.jpg" alt="" />
                </a>
                <?php
        }
    
        elseif(($row['model_name']) == "creta")
        {
    ?>
                <a href="#!">
                    <img class="rounded-t-lg" src="http://localhost/covid/creta.jpg" alt="" />
                </a>
                <?php
        }
    
        elseif(($row['model_name']) == "bugati")
        {
    ?>
                <a href="#!">
                    <img class="rounded-t-lg" src="http://localhost/covid/bugati.jpg" alt="" />
                </a>
                <?php
        }
    
        elseif(($row['model_name']) == "ferrari")
        {
    ?>
                <a href="#!">
                    <img class="rounded-t-lg" src="http://localhost/covid/ferrari.jpg" alt="" />
                </a>
                <?php
        }
    
        elseif(($row['model_name']) == "pulsar")
        {
    ?>
                <a href="#!">
                    <img class="rounded-t-lg" src="http://localhost/covid/pulsar.jpg" alt="" />
                </a>
                <?php
        }
    
        elseif(($row['model_name']) == "jaguar")
        {
    ?>
                <a href="#!">
                    <img class="rounded-t-lg" src="http://localhost/covid/jaguar.jpg" alt="" />
                </a>
                <?php
        }
    
        elseif(($row['model_name']) == "ktm duke")
        {
    ?>
                <a href="#!">
                    <img class="rounded-t-lg" src="http://localhost/covid/ktm_duke.jpeg" alt="" />
                </a>
                <?php
        }
    
        else 
        {
    ?>
                <a href="#!">
                    <img class="rounded-t-lg" src="http://localhost/covid/car_rest.jpg" alt="" />
                </a>
                <?php
        }
    ?>


                <div class="p-6">
                    <h5 class="text-gray-900 text-xl font-medium mb-2">Details</h5>
                    <p class="text-gray-700 text-base mb-4">
                        City Name : <?php echo ($row['city'])?><br>
                        Type : <?php echo ($row['type'])?><br>
                        modal Name : <?php echo ($row['model_name'])?><br>
                        modal Year : <?php echo ($row['model_year'])?><br>
                        Registration No : <?php echo ($row['registration_no'])?><br>
                        Added Date : <?php echo (new DateTime($row['DOP']))->format('Y-m-d H:i:s'); ?><br>
                        Base Price : <?php echo "₹".$row['base_price']; ?><br>
                        Price/Days : <?php echo "₹".$row['priceperKM']; ?><br>
                    </p>
                    <button type="button" class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" style = "background: orangered;" ><a href="remove_provided_vehicle.php?vid=<?php echo $row['v_id']; ?>"><input type="submit"
                                name="cancel" value="Remove"></button>
                </div>
            </div>
        </div>

        <?php
        $count++;
        if($count%3==0)
        {
        ?>
            </div>
        <?php
        }   
        }
        ?>

</div>






</body>

</html>