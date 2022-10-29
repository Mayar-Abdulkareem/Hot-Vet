<?php
try {
    $db = new mysqli('localhost', 'root', '', 'hotvet');
    session_start();
    if (empty($_SESSION['ncartitems']))
        $_SESSION['ncartitems'] = 0;
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
    <!-- css page -->
    <link rel="stylesheet" href="../CSS/LightTemplate.css" id="template">
    <link rel="stylesheet" href="../CSS/HomeLight.css" id="cssPage">
    <!-- jquery ui -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script rel="stylesheet" src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script rel="stylesheet" src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- ScrollReveal-->
    <script src="https://unpkg.com/scrollreveal"></script>
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
            //alert("<?php //echo $_SESSION['active'] ;?>//");
            let theme = localStorage.getItem("theme");
            if (theme && theme === "dark-mode") {
                document.getElementById("template").setAttribute("href", "../CSS/DarkTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/HomeDark.css");
            } else {

                document.getElementById("template").setAttribute("href", "../CSS/LightTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/HomeLight.css");
            }
        }

        function swapStyleSheet() {
            let element = document.body;
            element.classList.toggle("dark-mode");

            let theme = localStorage.getItem("theme");
            if (theme && theme === "dark-mode") {
                localStorage.setItem("theme", "light-mode");
                document.getElementById("template").setAttribute("href", "../CSS/LightTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/HomeLight.css");
            } else {
                localStorage.setItem("theme", "dark-mode");
                document.getElementById("template").setAttribute("href", "../CSS/DarkTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/HomeDark.css");
            }
        }

        function logout() {
            <?php
            //            session_destroy(); ?>
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

<body onload="loadMode();">

<?php if(!isset($_SESSION['rol']) or $_SESSION['rol'] == 1){ ?>
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
<?php
}
else if($_SESSION['rol'] == 2){ ?>
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
<?php }
else if($_SESSION['rol'] == 3){ ?>
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
                        <a class="nav-link" href="../html/edit.php">E_Employees</a>
                    </li>
                    <li class="nav-item ms-auto" >
                        <a class="nav-link" href="../html/edithome.php">E_Home</a>
                    </li>
                    <li class="nav-item ms-auto" id="orderr">
                        <a class="nav-link" href="../html/mcharts.php">Sales</a>
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
    <?php }
?>
<div id="draggable" class="ui-widget-content theme" style="background-color: #2a2b2e !important;"
     onclick="swapStyleSheet();">
    <i id="brightness" class="bi bi-brightness-high-fill theme" style="font-size: 3rem;"></i>
</div>


<div id="containment">
    <!--carousel-->
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../Images/SliderImg1.png" class="d-block w-100" alt="cat">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Make a new Friend!</h1>
                    <h3>our vet helps a lot af animals.</h3>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../Images/SliderImg2.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Meet our Doctors!</h1>
                    <h3>our Doctors are very qualified.</h3>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../Images/SliderImg3.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Adopt don't buy!</h1>
                    <h3>Millions of pets are waiting for a warm home</h3>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!--carousel-->

    <?php

    try {

        $qryStr = 'select * from home';
        $res = $db->query($qryStr);
        for ($i = 0; $i < $res->num_rows; $i++) {
            $row = $res->fetch_assoc();
            $header = $row['header'];
            $text = $row['text'];
            $pic = 'data:image/jpg;base64,' . base64_encode(($row['picture'])); ?>

            <div id="contentId" class="container">
                <h1><?php echo $header ?></h1>
                <img src="<?php echo $pic ?>"
                     style="float: right; width:35vh; height: 30vh; margin-bottom: 50px; display: inline-block" alt="">
                <p>
                    <?php echo $text ?>
                </p>
            </div>
            <?php
        }
        $db->close();

    } catch (Exception $ex) {
        $ex->getMessage();
    }
    ?>

    <div class="container" id="content3Id">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <h1 id="vetsId">MEET OUR VETS</h1>
            </div>
        </div>


        <div class="row">
            <div class="col d-flex justify-content-center">
                <?php

                try {
                    $db = new mysqli('localhost', 'root', '', 'hotvet');
                    $qryStr = 'select * from vet';
                    $res = $db->query($qryStr);
                    for ($i = 0; $i < $res->num_rows; $i++) {
                        $row = $res->fetch_assoc();
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        $specialty = $row['specialty'];
                        $exp = $row['experience'];
                        $phone = $row['phone'];
                        $email = $row['email'];
                        $facebook = $row['facebook'];
                        $pic = 'data:image/jpg;base64,' . base64_encode(($row['picture']));
                        ?>
                        <div class="flip-card">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <img class="DoctorImage" src="<?php echo $pic ?>">
                                </div>
                                <div class="flip-card-back" style="overflow: auto;">
                                    <h5><?php echo 'Dr.', $fname, $lname ?></h5>
                                    <p style="text-align: left;">
                                        <br><br>
                                        Specialty: <span class="txt"> <?php echo $specialty ?> <br> <br> </span>
                                        Experience: <span class="txt"><?php echo $exp ?> <br> <br></span>
                                        Phone: <span class="txt"> <?php echo $phone ?> <br> <br></span>
                                    </p>
                                    <!-- Facebook -->
                                    <a class="btn" href="<?php echo $facebook ?>" target="_blank" role="button">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                    <!-- Gmail -->
                                    <a class="btn" href="mailto: <?php echo $email ?> " target="_blank" role="button">
                                        <i class="bi bi-envelope-fill"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    $db->close();

                } catch (Exception $ex) {
                    $ex->getMessage();
                }
                ?>
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
                            <a class="btn" href="https://www.facebook.com/HOT-VET-100625291447867" target="_blank"
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

        <script>
            ScrollReveal({
                reset: false, //if reset is activated each time I scroll, the elements will be revealed from beginning
                // distance: '60px',
                duration: 3000,
                delay: 100
            });


            ScrollReveal().reveal('#contentId', {delay: 500});
            ScrollReveal().reveal('#content3Id', {delay: 1000});


        </script>

        <scrip src="../node_modules/jquery/dist/jquery.slim.min.map"></scrip>
        <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>