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
    <link rel="stylesheet" href="../CSS/OrderLight.css" id="cssPage">
    <link rel="stylesheet" href="../CSS/cart.css" id="cssPage2">
    <!-- script pages-->
    <!--    <script src="../JavaScript/Login.js"></script>-->
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
                document.getElementById("cssPage").setAttribute("href", "../CSS/OrderDark.css");
                document.getElementById("cssPage2").setAttribute("href", "../CSS/CartDark.css");
            } else {

                document.getElementById("template").setAttribute("href","../CSS/LightTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/OrderLight.css");
                document.getElementById("cssPage2").setAttribute("href", "../CSS/CartLight.css");
            }
        }
        function swapStyleSheet() {
            let element = document.body;
            element.classList.toggle("dark-mode");

            let theme = localStorage.getItem("theme");
            if (theme && theme === "dark-mode") {
                localStorage.setItem("theme", "light-mode");
                document.getElementById("template").setAttribute("href","../CSS/LightTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/OrderLight.css");
                document.getElementById("cssPage2").setAttribute("href", "../CSS/CartLight.css");
            } else {
                localStorage.setItem("theme", "dark-mode");
                document.getElementById("template").setAttribute("href","../CSS/DarkTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/OrderDark.css");
                document.getElementById("cssPage2").setAttribute("href", "../CSS/CartDark.css");
            }
        }


    </script>
    <style>
        .theme {
            position: absolute;
            margin-top: 30px;
            margin-bottom: 150px;
        }

        #brightness {
            position: absolute;
            z-index: 16;
            margin-top: 20px;
        }
    </style>

</head>

<body onload="loadMode()">


<!--navbar-->
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
                <li class="nav-item ms-auto" >
                    <a class="nav-link" href="../html/ePet.php">Pets</a>
                </li>
                <li class="nav-item ms-auto" >
                    <a class="nav-link" href="../html/eshop.php">Shop</a>
                </li>
                <li class="nav-item ms-auto" id="orderr">
                    <a class="nav-link" href="../html/eorder.php">Order</a>
                </li>
                <li class="nav-item ms-auto" id="appointmentt">
                    <a class="nav-link" href="../html/Requests.php">Requests</a>
                </li>

                <li class="nav-item ms-auto" id="profilee">
                    <a class="nav-link" href="../html/eProfile.php">Profile</a>
                </li>

                <li class="nav-item ms-auto" >
                    <a class="nav-link" href="../html/Login.php">Log out</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!--navbar-->
<div id="draggable" class="ui-widget-content theme" onclick="swapStyleSheet();">
    <i id="brightness" class="bi bi-brightness-high-fill theme" style="font-size: 4rem;"></i>
</div>

<!--<div id="draggable" class="ui-widget-content theme" onclick="swapStyleSheet();">-->
<!--    <i id="brightness" class="bi bi-brightness-high-fill theme" style="font-size: 4rem;"></i>-->
<!--</div>-->


<div id="containment">
    <!--  write your code here-->
    <div class="split left">
        <div class="containerOrders">
            <?php
            $query = "SELECT cart_id FROM `storeorders`;";
            $query_run = mysqli_query($db, $query);
            $check = mysqli_num_rows($query_run) > 0;
            if ($check) {
                while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>
                    <div class="card">
                        <div class="img-container">
                            <img class="card-imag" src="../images/logohotvet.png"></img>
                        </div>
                        <div class="card-description">
                            <h2 class="orderID"> Cart ID: <?php echo $row['cart_id'] ?></h2>
                            <form method="post">
                                <button type="submit" name="vdetailsbtn" class="btn"
                                        value="<?php echo $row['cart_id'] ?>">
                                    View order's details
                                </button>
                            </form>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
    <div class="split right">
        <?php if (isset($_POST['vdetailsbtn'])) {
            $_SESSION['cartofshame'] = $_POST['vdetailsbtn'];
        $query = "select item_id, quantity from receipt where cart_id = " . $_POST['vdetailsbtn'];
        $query_run = mysqli_query($db, $query);
        $check = mysqli_num_rows($query_run) > 0;
        if ($check) {
        ?>

        <div class="orderDetailsContainer" id="orderDetailsContainer">
            <p class="orderDetailsP"> Order details</p>
            <div class="row d-flex justify-content-md-end table-wrapper">

                <table class="content-table ">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th class="w-25">Item Name</th>
                        <th>Price</th>
                        <th>quantity</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = mysqli_fetch_assoc($query_run)) {
                        $queryx = 'select item_image, name, price from item where item_id = ' . $row['item_id'] . ';';
                        $query_runx = mysqli_query($db, $queryx);
                        $rowx = mysqli_fetch_assoc($query_runx);
                        ?>
                        <tr>

                            <td class="w-25 "><?php
                                echo '<img class="w-100 h-25" src="data:image/jpg;base64,' . base64_encode(($rowx['item_image'])) . '" />';
                                ?></td>
                            <td><?php echo $rowx['name']; ?></td>
                            <td><?php echo $rowx['price']; ?>$</td>
                            <td><?php echo $row['quantity']; ?></td>
                        </tr>
                    <?php }
                    } ?>

                    </tbody>
                </table>
                <p class="tracking"> Tracking : </p>
                <div class="dots">
                    <span class="dot1"></span>
                    <span class="road1"></span>
                    <span class="dot2"></span>
                    <span class="road2"></span>
                    <span class="dot3"></span>
                </div>
                <div class="dots">
                    <p class="trackingLevels">Processing</p>
                    <p class="trackingLevels">On The Way</p>
                    <p class="trackingLevels">Delivered</p>
                </div>
                <form method="post" >
                    <label style="margin-left: 5vh;" for="cars">Status:</label>
                    <select style="margin-bottom: 5vh; border: 0;" name="ostatus" id="ostatus">
                        <option value="0">Processing</option>
                        <option value="1">On The Way</option>
                        <option value="2">Delivered</option>
                    </select>
                    <input type="submit" class="btn" name="save" value="Save">
                    <input type="text" name="shame" value = "$_POST['vdetailsbtn']" style="visibility: hidden; display: none;">
                </form>
                <?php
                $query = "SELECT status FROM `storeorders` WHERE `cart_id`=" . $_POST['vdetailsbtn'] . ";";

                $query_run = mysqli_query($db, $query);
                $check = mysqli_num_rows($query_run);
                if ($check > 0) {
                    $row = mysqli_fetch_assoc($query_run);
                    $trackingFlag = $row['status'];
                    if ($trackingFlag == 0) {
                        echo '<style>
                                .dot1 {
                                    background:lightgreen;
                                }
                                .road1{
                                    background:lightgreen;
                                }
                                
                             </style>';}
                    elseif ($trackingFlag == 1) {
                        echo '<style>
                                .dot1 {
                                    background:lightgreen;
                                }
                                .road1{
                                    background:lightgreen;
                                }
                                .dot2 {
                                    background:lightgreen;
                                }
                                .road2{
                                    background:lightgreen;
                                }
                             </style>';
                    }
                    elseif ($trackingFlag == 2) {
                        echo '<style>
                                .dot1 {
                                    background:lightgreen;
                                }
                                .road1{
                                    background:lightgreen;
                                }
                                .dot2 {
                                    background:lightgreen;
                                }
                                .road2{
                                    background:lightgreen;
                                }
                                .dot3 {
                                    background:lightgreen;
                                }
                             </style>';
                    }

                }
                else {

                }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_POST['save'])){
    $track = $_POST['ostatus'];
    $query = "UPDATE `storeorders` SET `status` = '".$track ."' WHERE `storeorders`.`cart_id` = ".$_SESSION['cartofshame'].";";
    $query_run = mysqli_query($db, $query);

}
?>
<!--footer-->
<footer class="footerClass">
    <!-- Grid container -->
    <div class="container p-4 pb-0">

        <div class="row">

            <div class="col">
                <!-- Copyright -->
                <div class="text-center p-3">
                    <span class="text" href="#">Hot Vet website using: <br> bootstrap, HTM, CSS, JS, PHP </span>
                </div>
                <!-- Copyright -->
            </div>

            <div class="col">
                <!-- Copyright -->
                <div class="text-center p-3">
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
                    <a class="btn " href="https://www.facebook.com/HOT-VET-100625291447867" target="_blank"
                       role="button">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <!-- Gmail -->
                    <a class="btn" href="mailto:mayarabdilkareem1@gmail.com" target="_blank" role="button">
                        <i class="bi bi-envelope-fill"></i>
                    </a>
                    <!-- Google -->
                    <a class="btn btn-floating m-1" href="https://en.wikipedia.org/wiki/Animal" ratget="_blank"
                       role="button">
                        <i class="bi bi-google"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</footer>
<!--footer-->


<scrip src="../node_modules/jquery/dist/jquery.slim.min.map"></scrip>
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>