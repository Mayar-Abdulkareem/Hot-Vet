<?php
try {
    $db = new mysqli('localhost', 'root', '', 'hotvet');
    session_start();
} catch (Exception $e) {
    echo "No data base";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- jquery ui -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script rel="stylesheet" src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script rel="stylesheet" src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- css page -->
    <link rel="stylesheet" href="../CSS/LightTemplate.css" id="template">
    <link rel="stylesheet" href="../CSS/CartLight.css" id="cssPage">
    <!--    <link type="text/css" rel="stylesheet" href="../CSS/appointmetnlight.css" id="cssPage2">-->
    <!-- script pages-->
    <script type="text/javascript" src="../JavaScript/cart.js"></script>

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
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
                document.getElementById("cssPage").setAttribute("href", "../CSS/CartDark.css");
            } else {

                document.getElementById("template").setAttribute("href","../CSS/LightTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/CartLight.css");
            }
        }
        function swapStyleSheet() {
            let element = document.body;
            element.classList.toggle("dark-mode");

            let theme = localStorage.getItem("theme");
            if (theme && theme === "dark-mode") {
                localStorage.setItem("theme", "light-mode");
                document.getElementById("template").setAttribute("href","../CSS/LightTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/CartLight.css");
            } else {
                localStorage.setItem("theme", "dark-mode");
                document.getElementById("template").setAttribute("href","../CSS/DarkTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/CartDark.css");
            }
        }


    </script>
    <style>
        .theme{position: absolute;margin-top:30px; margin-bottom:150px;}
        #brightness{position: absolute; z-index: 16;margin-top:20px;}
    </style>
</head>
<div onload="loadMode()">

<?php
if (isset($_POST['buybutton'])) {
    $query = 'UPDATE `cart` SET `bought` = "yes" WHERE `cart`.`id` = ' . $_SESSION['cartID'] . ';';
    $query_run = mysqli_query($db, $query);
    $query = "INSERT INTO `storeorders` (`cart_id`, `c_username`, `status`) VALUES (".$_SESSION['cartID'].", '".$_SESSION['userID']."', '0');";
    echo $query;
    $query_run = mysqli_query($db, $query);
    $query = 'UPDATE `cart` SET `location` = "' . $_POST['Location'] . '" WHERE `cart`.`id` = ' . $_SESSION['cartID'] . ';';
    $query_run = mysqli_query($db, $query);
    $_SESSION['cartID'] = $_SESSION['cartID']+1;
    $query = 'INSERT INTO `CART` (`ID`, `C_USERNAME`) VALUES ("'.$_SESSION['cartID'].'", "'.$_SESSION['userID'].'");';
    echo $query;
    $query_run = mysqli_query($db, $query);
    $_SESSION['ncartitems'] = 0;

}
?>
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
<div class="container p-4 pb-0 m-5">
    <div class="col ">
        <div class="container" style="margin-top: 25px">
            <div class="row">
                <span id="cartId" >Your Cart</span>
            </div>
            <div class="row d-flex justify-content-md-end table-wrapper">
                <table class="content-table ">
                    <thead>
                    <tr>
                        <th>Delete</th>
                        <th>Item</th>
                        <th class="w-25">Item Name</th>
                        <th>Price</th>
                        <th class="w-25">Specification</th>
                        <th class="w-25">Quantity</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($_POST['deleteiconbutton'])) {
                        $query = 'delete FROM `receipt` WHERE `receipt`.`cart_id` = ' . $_SESSION['cartID'] . ' AND `receipt`.`item_id` = ' . $_POST['deleteiconbutton'] . ' AND `receipt`.`Specification` = "' . $_POST['deletehidden'] . '";';
                        $query_run = mysqli_query($db, $query);
                        $query = 'SELECT cart_id, SUM(quantity) FROM receipt where cart_id =' . $_SESSION['cartID'] . ' GROUP BY cart_id;';
                        $query_run = mysqli_query($db, $query);
                        $row = mysqli_fetch_assoc($query_run);
                        if (!isset($row['SUM(quantity)'])) {
                            $row['SUM(quantity)'] = 0;
                        }
                        $dif = $_SESSION['ncartitems'] - $row['SUM(quantity)'];
                        $_SESSION['ncartitems'] = $row['SUM(quantity)'];
                        $query = 'UPDATE item SET quantity = quantity + ' . $dif . ' WHERE item_id = ' . $_POST['deleteiconbutton'] . ";";
                        $query_run = mysqli_query($db, $query);
                        $query = 'select item_id, specification, quantity from receipt where cart_id =' . $_SESSION['cartID'] . ';';
                        $query_run = mysqli_query($db, $query);
                        $totp = 0;
                        $check = mysqli_num_rows($query_run) > 0;
                        if ($check) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                if (($row['specification'] == 1) || ($row['specification'] == 2) || ($row['specification'] == 3)) {
                                    $queryx = 'select price from item where item_id = ' . $row['item_id'] . ';';
                                    $query_runx = mysqli_query($db, $queryx);
                                    $rowx = mysqli_fetch_assoc($query_runx);
                                    $totp = $totp + ($row['quantity'] * $row['specification'] * $rowx['price']);
                                } else {
                                    $queryx = 'select price from item where item_id = ' . $row['item_id'] . ';';
                                    $query_runx = mysqli_query($db, $queryx);
                                    $rowx = mysqli_fetch_assoc($query_runx);
                                    $totp = $totp + ($row['quantity'] * $rowx['price']);
                                }


                            }
                        }
                        $queryx = 'UPDATE cart SET price =' . $totp . ' WHERE id = ' . $_SESSION['cartID'] . ";";
                        $query_runx = mysqli_query($db, $queryx);
                    }
                    ?>
                    <?PHP
                    $query1 = "SELECT item_id, quantity, specification FROM receipt where cart_id = '" . $_SESSION['cartID'] . "'";
                    $query_run1 = mysqli_query($db, $query1);
                    $check1 = mysqli_num_rows($query_run1) > 0;
                    if ($check1) {
                        $cnt = 0;
                        while ($row1 = mysqli_fetch_assoc($query_run1)) {
                            $cnt = $cnt + 1;
                            ?>
                            <tr>
                                <?php
                                $query2 = "SELECT name, price, item_image, specification FROM item where item.item_id = '" . $row1['item_id'] . "'";
                                $query_run2 = mysqli_query($db, $query2);
                                $row2 = mysqli_fetch_assoc($query_run2);
                                ?>
                                <form method="post">
                                    <td id="koko" class="deleteitem m-0" style="border:0;">
                                        <button id="deleteicon" name="deleteiconbutton"
                                                value="<?php echo $row1['item_id']; ?>" type="submit"
                                                style="margin: 0; padding: 0; width:30vh; height: 22vh;border:0">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <input type="text" name="deletehidden"
                                               value="<?php echo $row1['specification']; ?>"
                                               style="display: none; visibility: hidden;"></input>
                                    </td>
                                </form>
                                <td class="w-25 ">
                                    <?php
                                    echo '<img style="height: 15vh;" class="w-75" src="data:image/jpg;base64,' . base64_encode(($row2['item_image'])) . '" />';
                                    ?>
                                </td>
                                <td><?php echo $row2['name']; ?></td>

                                <td>
                                    <?php
                                    if ($row2['specification'] == "size") {
                                        echo $row1['quantity'] * $row1['specification'] * $row2['price'];
                                    } else {
                                        echo $row1['quantity'] * $row2['price'];
                                    }
                                    ?>
                                    $
                                </td>
                                <td>
                                    <?php if ($row2['specification'] == "size") {
                                        if ($row1['specification'] == 1) {
                                            echo "Small";
                                        } else if ($row1['specification'] == 2) {
                                            echo "Medium";
                                        } else {
                                            echo "Large";
                                        }

                                    } else {
                                        echo $row1['specification'];
                                    } ?>
                                </td>
                                <td class="align-content-center">
                                    <?php echo $row1['quantity']; ?>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<div class="container p-4 pb-0 m-5"
<fieldset class="p-4 pb-0">
    <legend class="float-none w-auto" id="guc">Fill your info</legend>
    <form id='buycart' class='input-group-buycart p-5' action="#" method="post">
        <label for="Location">Location: </label>
        <input type="text" id="Location" name="Location">
        <label style="margin-left: 20%">Total price: </label>
        <?php $query3 = "SELECT price FROM cart where id = '" . $_SESSION['cartID'] . "'";
        $query_run3 = mysqli_query($db, $query3);
        $row3 = mysqli_fetch_assoc($query_run3); ?>
        <output id="totalprice"><?php echo $row3['price']; ?></output>
        $
        <span style="float: right;">
            <button type="submit" name="buybutton" class="btn buycart" value="buy">Buy</button>
            </span>
    </form>
</fieldset>
</div>
<!--footer-->
<footer class="footerClass">
    <!-- Grid container -->
    <div class="container p-4 pb-0">

        <div class="row">

            <div class="col">
                <!-- Copyright -->
                <div class="text-center p-3">
                    <span class="text" href="#">Ho Vet website using: <br> bootstrap, HTM, CSS, JS, PHP </span>
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
                    <a class="btn " href="https://www.facebook.com/animallife.page" target="_blank" role="button">
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
</div>
<?php } ?>

<scrip src="../node_modules/jquery/dist/jquery.slim.min.map"></scrip>
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>