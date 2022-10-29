<?php
try {
    $db = new mysqli('localhost', 'root', '', 'hotvet');
    session_start();
    $_SESSION['ncartitems'] = 0;
    unset($_SESSION['rol']);
    unset($_SESSION['userID']);
} catch (Exception $e) {
    echo "No data base";
}
?>


<?php
try {

    if (isset($_POST['login'])) {
        if (isset($_POST['Email']) and isset($_POST['password'])) {
            $email = $_POST['Email'];
            $pass = $_POST['password'];
            $qry = "select * from user where email='" . $email . "' AND   password='" . sha1($pass) . "'";
            $result = $db->query($qry);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['userID'] = $row['userid'];
                $_SESSION['active'] = 1;
                $role = $row['role'];

                $sql1 = "SELECT id FROM `cart` where c_username = " . $_SESSION['userID'] . " ORDER BY id DESC LIMIT 1 ;";
                $query_run = mysqli_query($db, $sql1);
                if ($query_run->num_rows > 0) {
                    $row = mysqli_fetch_assoc($query_run);
                    $cartID = $row['id'];
                    $_SESSION['cartID'] = $cartID;
                }
                $_SESSION['active'] = 1;

                $query = 'SELECT SUM(quantity) FROM receipt where cart_id =' . $_SESSION['cartID'] . ';';
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $_SESSION['ncartitems'] = $row['SUM(quantity)'];
                }
                if ($role == 1) {
                    $_SESSION['rol'] = 1;
                    header('Location:Home.php');

                } elseif ($role == 2) {
                    $_SESSION['rol'] = 2;
                    header('Location:Home.php');

                } else {
                    $_SESSION['rol'] = 3;
                    header('Location:Home.php');

                }
            } else {
                //  echo "<script> window.onload = function() {displayError('ERROR!  ','Incorrect email or password');login()}; </script>";
                require "Notification.php";
                $Box = new msgBox();
                $Box->title = "ERROR!";
                $Box->massage = "Incorrect email or password " . sha1($pass);
                $Box->color = "green";
                $Box->color = "#f44336";
                $Box->display();

            }
        }
    }


    if (isset($_POST['register'])) {

        if (isset($_POST['First']) and isset($_POST['last']) and isset($_POST['Address']) and isset($_POST['phone'])
            and isset($_POST['Email']) and isset($_POST['Password']) and isset($_POST['Confirm'])) {
            $first = $_POST['First'];
            $final = $_POST['last'];
            $addres = $_POST['Address'];
            $phon = $_POST['phone'];
            $email = $_POST['Email'];
            $Password = $_POST['Password'];
            $confirm = $_POST['Confirm'];
            $exist = 0;

            $sql = "SELECT email FROM `user` WHERE email='" . $email . "';";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                $exist = 1;
            }

            if ($exist) {
                require "Notification.php";
                $Box = new msgBox();
                $Box->title = "ERROR!";
                $Box->massage = "This account already exist";
                $Box->color = "#f44336";
                $Box->display();
            } elseif ($confirm != $Password) {
                require "Notification.php";
                $Box = new msgBox();
                $Box->title = "ERROR!";
                $Box->massage = "Password and Confirm password doesn't match";
                $Box->color = "#f44336";
                $Box->display();
            } elseif (!is_numeric($phon)) {
                require "Notification.php";
                $Box = new msgBox();
                $Box->title = "ERROR!";
                $Box->massage = "Phone should be a number";
                $Box->color = "#f44336";
                $Box->display();
            } elseif (strlen($Password) < 6) {
                require "Notification.php";
                $Box = new msgBox();
                $Box->title = "ERROR!";
                $Box->massage = "Your password should be at least 6 character";
                $Box->color = "#f44336";
                $Box->display();
            } else {
                $Password = sha1($_POST['Password']);
                $userID = 0;
                // userID = new ID
                $sql = "SELECT userid FROM user ORDER BY userid DESC LIMIT 1;";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $userID = $row['userid'];
                    $userID++;
                } else
                    $userID = 0;
                // insert the user
                $sql1 = "INSERT INTO `user` (`userid`,`fname`, `lname`, `Address`, `email`, `phone`, `password`, `role`) VALUES
       ( '" . $userID . "' , '" . $first . "','" . $final . "','" . $addres . "','" . $email . "'," . $phon . ",'" . $Password . "',1)";
                if ($db->query($sql1) == TRUE) {
                    echo $sql1;
//                    $query_run = mysqli_query($db, $sql1);
                    $_SESSION['userID'] = $userID;
                    // give him a cart
                    // id
                    $sql = "SELECT id FROM cart ORDER BY id DESC LIMIT 1;";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $cartID = $row['id'];
                        $cartID++;
                    } else{
                        $cartID = 0;
                    }
                    $cid = 0;
                    // give a cart to this id
                    $sql1 = "INSERT INTO `cart`(`c_username`,`id`) VALUES (" . $userID . "," . $cartID . ");";
                    $query_run = mysqli_query($db, $sql1);
                    $sql1 = "SELECT c_username FROM `cart` where id= " . $userID . " ORDER BY id DESC LIMIT 1 ;";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $cid = $row['id'];
                    }

                    $_SESSION['cartID'] = $cid;
                    $_SESSION['active'] = 1;
                    $_SESSION['ncartitems'] = 0;

                    require "Notification.php";
                    $Box = new msgBox();
                    $Box->title = "SUCCESS!";
                    $Box->massage = "Signed successfully";
                    $Box->color = "green";
                    $Box->display();
                    header('Location:Home.php');
                } else {
                    require "Notification.php";
                    $Box = new msgBox();
                    $Box->title = "ERROR in sql";
                    $Box->massage = $db->error;
                    $Box->color = "#f44336";
                    $Box->display();
                }

            }

        } else {
            require "Notification.php";
            $Box = new msgBox();
            $Box->title = "ERROR!";
            $Box->massage = "Fill all the fields";
            $Box->color = "#f44336";
            $Box->display();
        }
    }
} catch (Exception $e) {
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
    <link rel="stylesheet" href="../CSS/LoginLight.css" id="cssPage">
    <!-- jquery ui -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- script pages-->
    <script src="../JavaScript/Login.js"></script>
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
                document.getElementById("template").setAttribute("href", "../CSS/DarkTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/LoginDark.css");
            } else {

                document.getElementById("template").setAttribute("href", "../CSS/LightTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/LoginLight.css");
            }
        }

        function swapStyleSheet() {
            let element = document.body;
            element.classList.toggle("dark-mode");

            let theme = localStorage.getItem("theme");
            if (theme && theme === "dark-mode") {
                localStorage.setItem("theme", "light-mode");
                document.getElementById("template").setAttribute("href", "../CSS/LightTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/LoginLight.css");
            } else {
                localStorage.setItem("theme", "dark-mode");
                document.getElementById("template").setAttribute("href", "../CSS/DarkTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/LoginDark.css");
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

<body onload="login();loadMode();">

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


<div id="draggable" class="ui-widget-content theme" onclick="swapStyleSheet()">
    <i id="brightness" class="bi bi-brightness-high-fill theme" style="font-size: 3rem;"></i>
</div>

<div id="containment" class="container-fluid">
    <div class="row">
        <div class="col-5">

            <div class=" fullBlock">
                <aside>
                    <div class=" form-box">
                        <div class=" welcome"> Welcome</div>
                        <div class='button-box'>
                            <button type='button' id='loginButton' onclick="login()">Log In</button>
                            <button type='button' id='registerButton' onclick="register()">Register</button>
                        </div>
                        <form id='login' class='input-group-login' action="Login.php" method="post">


                            <input type='email' class='input-field' placeholder='Email' name="Email" required>
                            <input type='password' class='input-field' placeholder='Enter Password' name="password"
                                   required>
                            <button type='submit' class='submit-btn' name="login">Log In</button>


                        </form>
                        <form id='register' class='input-group-register' action="#" method="post">
                            <input type='text' class='input-field' placeholder='First Name' name="First" required>
                            <input type='text' class='input-field' placeholder='Last Name ' name="last" required>
                            <input type='text' class='input-field' placeholder='Address' name="Address" required>
                            <input type='tel' class='input-field' placeholder='phone number' name="phone" required>
                            <input type='email' class='input-field' placeholder='Email' name="Email" required>
                            <input type='password' class='input-field' placeholder='Enter Password' name="Password"
                                   required>
                            <input type='password' class='input-field' placeholder='Confirm Password' name="Confirm"
                                   required>
                            <button type='submit' class='submit-btn' name="register">Register</button>
                        </form>
                    </div>
                </aside>
            </div>

        </div>


        <div class="col">
            <img src="../Images/StandingCat.png" alt="cat" id="catId">
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