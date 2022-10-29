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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- css page-->
    <!--    <link rel="stylesheet" href="../CSS/Shoplight.css">-->
    <link rel="stylesheet" href="../CSS/Petslight.css" id="cssPage">
    <!-- JavaScript Page-->
    <script type="text/javascript" src="../JAVASCRIPT/Shop.js"></script>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- tab header-->
    <title>Hot Vet</title>
    <link rel="icon" type="image/*" href="../Images/HotVetLogo.png">
    <script>
        let flag = true;
        let pos = 0;
        $(document).ready(
            function () {
                $('#draggable').draggable({axis: 'y', containment: "#containment", snap: true});
            }
        );

        function loadMode() {
            let theme = localStorage.getItem("theme");
            if (theme && theme === "dark-mode") {
                document.getElementById("cssPage").setAttribute("href", "../CSS/PetsDark.css");
            } else {

                document.getElementById("cssPage").setAttribute("href", "../CSS/PetsLight.css");
            }
        }

        function swapStyleSheet() {
            let element = document.body;
            element.classList.toggle("dark-mode");

            let theme = localStorage.getItem("theme");
            if (theme && theme === "dark-mode") {
                localStorage.setItem("theme", "light-mode");
                document.getElementById("cssPage").setAttribute("href", "../CSS/PetsLight.css");
            } else {
                localStorage.setItem("theme", "dark-mode");
                document.getElementById("cssPage").setAttribute("href", "../CSS/PetsDark.css");
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
<!--navbar-->
<div id="draggable" class="ui-widget-content theme" onclick="swapStyleSheet();">
    <i id="brightness" class="bi bi-brightness-high-fill theme" style="font-size: 4rem;"></i>
</div>

<div id="containment">
    <!--</div>-->
    <div class="container p-0">
        <img src="../images/adoption.png" class="d-block w-100 p-0 m-0" alt="Norway">
        <div class="text-block">
            <p>“An animal’s eyes have the power to speak a great language.” –Martin Buber</p>
        </div>
    </div>

    <div class=" container container-fluid">
        <?php
        if (!isset($filtersql) && !isset($petsfiltered)) {
            $query = "SELECT id, name, type, age, gender, color, pet_image, about FROM pet where pet.adopted = 'no'";
        }
        $query_run = mysqli_query($db, $query);
        $check = mysqli_num_rows($query_run) > 0;
        if ($check) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                ?>
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <?php
                            echo '<img class="petsForAdoption" src="data:image/jpg;base64,' . base64_encode(($row['pet_image'])) . '" />';
                            ?>
                            <h1 class="petnamefront"><?php echo $row['name'] ?></h1>
                        </div>
                        <div class="flip-card-back">
                            <h1 class="petnameback"><?php echo $row['name'] ?></h1>
                            <p class="aboutpet"> <?php echo $row['about'] ?> </p>
                            <pre>Gender    Color   Age</pre>
                            <pre>     <?php echo $row['gender'] ?>    <?php echo $row['color'] ?>   <?php echo $row['age'] ?>months</pre>

                            <p>
                            <form method="post">
                                <button name="adopt" type="submit" class="btn badopt" value="<?php echo $row['id'] ?>">
                                    Adopt
                                </button>

                                <input type="checkbox" id="sure" name="sure"
                                       value="sure">
                                <label for="sure"> Check to confirm</label><br>
                            </form>
                            <!--                            <button type="button" class="btn bdonate" value="Donate">-->
                            <!--                                Donate-->
                            <!--                            </button>-->
                            </p>
                            <a class="btn baskaboutthispet" href="mailto:mayarabdilkareem1@gmail.com" target="_blank"
                               role="button">
                                Ask About This Pet
                            </a>
                        </div>
                    </div>
                </div>
            <?php }
        } ?>
    </div>
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
<?php
if (!isset($_SESSION['userID'])) {
    require "Notification.php";
    $Box = new msgBox();
    $Box->title = "Not Allowed!";
    $Box->massage = "You need to log in first!";
    $Box->color = "red";
    $Box->display();
} else {
    if (isset($_POST['adopt'])) {
        if (isset($_POST['sure'])) {
            $query = "UPDATE `pet` SET `adopted` = 'yes' WHERE `pet`.`ID` = " . $_POST['adopt'] . ";";
            $query_run = mysqli_query($db, $query);
            $query = "UPDATE `pet` SET `c_id` = '" . $_SESSION['userID'] . "' WHERE `pet`.`ID` = " . $_POST['adopt'] . ";";
            $query_run = mysqli_query($db, $query);
            require "Notification.php";
            $Box = new msgBox();
            $Box->title = "Nice move!";
            $Box->massage = "The pet is waiting for you at the clinic.";
            $Box->color = "deepskyblue";
            $Box->display();
        } else {
            require "Notification.php";
            $Box = new msgBox();
            $Box->title = "Failed!";
            $Box->massage = "If you are willing, make sure to check the box and try again.";
            $Box->color = "orange";
            $Box->display();
        }
    }
}
?>
</body>
</html>