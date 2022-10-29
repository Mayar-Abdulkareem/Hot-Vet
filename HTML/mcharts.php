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
    <link rel="stylesheet" href="../CSS/Petslight.css">
    <!-- JavaScript Page-->
    <script type="text/javascript" src="../JAVASCRIPT/Shop.js"></script>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!--charts-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <!-- tab header-->
    <title>Hot Vet</title>
    <link rel="icon" type="image/*" href="../Images/HotVetLogo.png">
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
<!--navbar-->
<div id="containment" class="container-fluid">
    <canvas id="myChart" style="width:100%;max-width:700px; margin-top: 20vh;">
    <script>
        const items = [];
        const qnts = [];
        const clr = [];
        <?php
        $query = "select item_id, quantity from item;";
        $query_run = mysqli_query($db, $query);
        $check = mysqli_num_rows($query_run) > 0;
        if ($check) {
        while ($row = mysqli_fetch_assoc($query_run)) {?>
        items.push("<?php echo $row['item_id']; ?>");
        qnts.push("<?php echo $row['quantity']; ?>");
        clr.push("#099aac");
        <?php
        }
        }
        ?>
        new Chart("myChart", {
            type: "bar",
            data: {
                labels: items,
                datasets: [{
                    backgroundColor: clr,
                    data: qnts

                }]
            },
            options: {
                legend: {display: false},
                title: {
                    display: true,
                    text: "Stock"
                }
            }
        });

    </script>
    </canvas>
    <div id="myPlot" style="width:100%;max-width:700px"></div>

    <script>
        const carts = [];
        const prices = [];
        const clr2 = [];
        <?php
        $query = "select id, price from cart;";
        $query_run = mysqli_query($db, $query);
        $check = mysqli_num_rows($query_run) > 0;
        if ($check) {
        while ($row = mysqli_fetch_assoc($query_run)) {?>
        carts.push("<?php echo $row['id']; ?>");
        prices.push("<?php echo $row['price']; ?>");
        clr2.push("#099aac");
        <?php
        }
        }
        ?>

        var layout = {title:"Sold Carts"};

        var data = [{labels:carts, values:prices, type:"pie"}];

        Plotly.newPlot("myPlot", data, layout);
    </script>
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
</body>
</html>