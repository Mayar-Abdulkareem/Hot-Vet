<?php
try {
    $db = new mysqli('localhost', 'root', '', 'hotvet');
    session_start();
} catch (Exception $e) {
    echo "No data base";
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- css page -->
    <link rel="stylesheet" href="../CSS/LightTemplate.css" id="template">
    <link rel="stylesheet" href="../CSS/AppointmentLight.css" id="cssPage">
    <!-- script pages-->
    <script src="../JavaScript/Appointment.js"></script>
    <!-- jquery ui -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- tab header-->
    <title>Hot Vet</title>
    <link rel="icon" type="image/*" href="../Images/HotVetLogo.png">
    <script>
        let flag = true;
        let pos = 0;
        $(document).ready(
            function (){
                $('#draggable').draggable({axis: 'y', containment: "#containment", snap: true});}
        );

        function loadMode(){
            let theme = localStorage.getItem("theme");
            if (theme && theme === "dark-mode") {
                document.getElementById("template").setAttribute("href","../CSS/DarkTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/AppointmentDark.css");
            } else {

                document.getElementById("template").setAttribute("href","../CSS/LightTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/AppointmentLight.css");
            }
        }
        function swapStyleSheet() {
            let element = document.body;
            element.classList.toggle("dark-mode");

            let theme = localStorage.getItem("theme");
            if (theme && theme === "dark-mode") {
                localStorage.setItem("theme", "light-mode");
                document.getElementById("template").setAttribute("href","../CSS/LightTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/AppointmentLight.css");
            } else {
                localStorage.setItem("theme", "dark-mode");
                document.getElementById("template").setAttribute("href","../CSS/DarkTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/AppointmentDark.css");
            }
        }


    </script>
    <style>
        .theme{position: absolute;margin-top:30px; margin-bottom:150px;}
        #brightness{position: absolute; z-index: 16;margin-top:20px;}
    </style>
</head>

<body onload="loadMode()">

<nav class="navbar navbar-expand-lg fixed-top navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <table>
                <tr>
                    <td>
                        <img src="../Images/HotVetLogo.png" class="d-inline-block align-top" id="topLogo" alt="Logo">
                    </td>
                    <td>
                        <h1><span id="hotId">Hot</span> <span id="vetId">Vet</span></h1>
                    </td>
                </tr>
            </table>
        </a>
        <!--        button that appear when collapse-->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nvbCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="nvbCollapse">
            <ul class="navbar-nav  ms-auto">
                <li class="nav-item ms-auto">
                    <a class="nav-link" href="../html/home.php">Home</a>
                </li>
                <li class="nav-item ms-auto">
                    <a class="nav-link" href="../html/Pets.php">Pets</a>
                </li>
                <li class="nav-item ms-auto">
                    <a class="nav-link" href="../html/shop.php">Shop</a>
                </li>
                <li class="nav-item ms-auto">
                    <!--                    <a class="nav-link cart position-relative d-inline-flex" href="Cart.html?cart_id=">-->
                    <a class="nav-link cart position-relative d-inline-flex" onclick="showcart();"
                       href="../html/cart.php">
                        <span class="cart-basket d-flex align-items-center justify-content-center"><?php echo $_SESSION['ncartitems']; ?></span>
                        <i class="fas fa fa-shopping-cart fa-lg" style="font-size:24px;"></i>
                    </a>
                </li>
                <li class="nav-item ms-auto">
                    <a class="nav-link" href="../html/order.php">Order</a>
                </li>
                <li class="nav-item ms-auto">
                    <a class="nav-link" href="../html/appointment.php">Appointments</a>
                </li>
                <?php
                if (isset($_SESSION['userID'])) {
                    ?>
                    <li class="nav-item ms-auto" id="profilee">
                        <a class="nav-link" href="../html/Profile.php">Profile</a>
                    </li>
                    <?php
                }
                ?>

                <li class="nav-item ms-auto">
                    <a class="nav-link" href="../html/login.php">
                        <?php
                        if (!isset($_SESSION['userID']))
                            echo "Log in";
                        else
                            echo "Log out"
                        ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>



<div id="draggable" class="ui-widget-content theme" onclick="swapStyleSheet();">
    <i id="brightness" class="bi bi-brightness-high-fill theme" style="font-size: 4rem;"></i>
</div>
<?php
if (!isset($_SESSION['userID'])) {
    require "Notification.php";
    $Box = new msgBox();
    $Box->title = "Nothing to display!";
    $Box->massage = "You need to log in first!";
    $Box->color = "Orange";
    $Box->display();
} else {
?>


<div  id="containment">


    <?php
    if(isset($_POST['submit-btn'])){

        if(!empty($_POST['docName']) and !empty($_POST['time']) and !empty($_POST['date'])){

            $query = "SELECT userid FROM vet WHERE fname = '".$_POST['docName']."'";
            $result = $db -> query($query);
            if ($result->num_rows >0){
                $row = $result->fetch_assoc();
                $docID = $row['userid'];

                $query = "INSERT INTO `request` (`id`, `userid`, `vetid`, `date`, `time`, `accept`, `done`) VALUES 
                        (NULL, '".$_SESSION['userID']."', '".$docID."', '".$_POST['date']."', '".$_POST['time']."',0,0)";
                $result = $db->query($query);

                require "Notification.php";
                $Box = new msgBox();
                $Box->title="SUCCESS!";
                $Box->massage="You have requested your appointment successfully";
                $Box->color="green";
                $Box -> display();

            }
            else{
                require "Notification.php";
                $Box = new msgBox();
                $Box->title="ERROR!";
                $Box->massage="We don't have a doctor with this name";
                $Box->color="red";
                $Box -> display();
            }
        }
        else{
            require "Notification.php";
            $Box = new msgBox();
            $Box->title="ERROR!";
            $Box->massage="Please fill all he fields";
            $Box->color="red";
            $Box -> display();}
    }


    ?>

    <div class="container ">

        <div class="row">
            <div class="col d-flex justify-content-md-end">
                    <form action="#" method="post">
                    <div class="container form-content" >
                        <div class="row">
                            <span id="bookId">Book an appointment</span>
                        </div>
                        <fieldset class="p-2 ml-2">
                            <legend class="float-none w-auto p-2" style="font-size: medium">Personal Details </legend>
                        <div class="row " style="margin-bottom: 10px">
                            <div class="col"><input type="text" name="fname" placeholder="Enter your first name" ></div>
                            <div class="col"><input type="text" name="lname" placeholder="Enter your last name" ></div>
                        </div>
                        <div class="row" style="margin-bottom: 10px">
                            <div class="col"><input type="email" name="email" placeholder="Enter your email" ></div>
                            <div class="col"><input type="text" name="phone" placeholder="Enter your cell phone" ></div>
                        </div>
                        </fieldset>
                        <fieldset class="p-2 ml-2">
                            <legend class="float-none w-auto p-2" style="font-size: medium">Appointment Details </legend>
                            <div class="row" style="margin-bottom: 10px">
                                <div class="col"><input type="date" name="date" placeholder="Date"  ></div>
                                <div class="col"><input type="time" name="time" placeholder="Time"  ></div>
                            </div>
                            <div class="row" style="margin-bottom: 10px">
                            <div class="col"><input type="text" name="docName" placeholder="Doctor Name" style="width: 100%" ></div>
                            </div>
                        </fieldset>
                        <fieldset class="p-2 ml-2">
                            <legend class="float-none w-auto p-2" style="font-size: medium"> Description </legend>
                        <div class="row">
                            <div class="col">
                                <textarea id="txtArea" name="description" placeholder="Describe the disease state" style="width:100%;" rows="5"></textarea>
                            </div>
                        </div>
                        </fieldset>
                        <div class="row ">
                            <div class="col d-flex justify-content-center">
                                <form method="post" action="#">
                                <button id="submit-btn" type="submit" name="submit-btn" style="width: 50%;padding: 5px;">Submit</button> </form>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="col ">
                <div class="container" style="margin-top: 25px">
                    <div class="row">
                        <span id="appId">My Appointment</span>
                    </div>
                    <div class="row">

                    </div>
                <div class="row d-flex justify-content-center table-wrapper">
                <table class="content-table ">
                    <thead>
                    <tr><th>Date</th><th>Time</th><th>Accept</th>
                        <th>Response</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT * FROM `request` where userid =".$_SESSION['userID'];
                    $result = $db->query($query);
                    $dateVar = "";
                    $timeVar="";
                    $accepted="";
                    $done="";
                    if($result){
                    for ($i=0;$i<$result->num_rows;$i++){
                        $row = $result->fetch_assoc();
                        $dateVar = $row['date'];
                        $timeVar = $row['time'];
                        $accepted = $row['accept'];
                        $done = $row['Done'];
                    ?>
                    <tr><td><?php echo $dateVar ?></td>
                        <td><?php echo $timeVar ?></td>
                        <td><?php echo $accepted ?></td>
                        <td><?php echo $done ?></td>
                    </tr>
                    <?php
                    }
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            </div>
               </div>
        </div>
    </div>
</div>


<!--footer-->
<footer class="footerClass">
    <!-- Grid container -->
    <div class="container p-4 pb-0">

        <div class="row">

            <div class="col">
                <!-- Copyright -->
                <div class="text-center p-3" >
                    <span class="text" href="#">Hot Vet website using: <br> bootstrap, HTM, CSS, JS, PHP </span>
                </div>
                <!-- Copyright -->
            </div>

            <div class="col">
                <!-- Copyright -->
                <div class="text-center p-3" >
                    © 2022 Copyright:
                    <span class="text" href="#">Mayar and Jenan</span>
                </div>
                <!-- Copyright -->
            </div>

            <div class="col">
                Contact us
                <!-- Section: Social media -->
                <div class="mb-4">
                    <!-- Facebook -->
                    <a class="btn " href="https://www.facebook.com/HOT-VET-100625291447867" target="_blank" role="button">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <!-- Gmail -->
                    <a class="btn" href="mailto:mayarabdilkareem1@gmail.com" target="_blank" role="button">
                        <i class="bi bi-envelope-fill"></i>
                    </a>
                    <!-- Google -->
                    <a class="btn btn-floating m-1" href="https://en.wikipedia.org/wiki/Animal" ratget="_blank" role="button">
                        <i class="bi bi-google"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</footer>
<!--footer-->
<?php } ?>


<scrip src="../node_modules/jquery/dist/jquery.slim.min.map"></scrip>
<script src = "../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>