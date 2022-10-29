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
<!--  <link rel="stylesheet" href="../CSS/HomeLight.css" id="cssPage">-->
  <!-- script pages-->
  <script src="../JavaScript/Login.js"></script>
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

    function swapStyleSheet() {

      if(flag) {
        document.getElementById("template").setAttribute("href","../CSS/LightTemplate.css");
        document.getElementById("cssPage").setAttribute("href", "../CSS/HomeLight.css");
        flag = false;
      }
      else{
        document.getElementById("template").setAttribute("href","../CSS/DarkTemplate.css");
        document.getElementById("cssPage").setAttribute("href", "../CSS/HomeDrak.css");
        flag = true;
      }
    }

  </script>
  <style>
    .theme{position: absolute;margin-top:30px; margin-bottom:150px;}
    #brightness{position: absolute; z-index: 16;margin-top:20px;}
  </style>

</head>

<body>


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
                <li class="nav-item ms-auto">
                    <a class="nav-link" href="../html/login.php">Log in</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--navbar-->

<!--<div id="draggable" class="ui-widget-content theme" onclick="swapStyleSheet();">-->
<!--  <i id="brightness" class="bi bi-brightness-high-fill theme" style="font-size: 4rem;"></i>-->
<!--</div>-->


<div  id="containment">
<!--  write your code here-->
  <div class="containerOrders" >

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


<scrip src="../node_modules/jquery/dist/jquery.slim.min.map"></scrip>
<script src = "../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>