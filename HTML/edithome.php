<?php
try {
    $db = new mysqli('localhost', 'root', '', 'hotvet');
    session_start();
    $_SESSION['userID'] = 1;
    $_SESSION['active'] = 0;

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




<div id="draggable" class="ui-widget-content theme" onclick="swapStyleSheet();">
    <i id="brightness" class="bi bi-brightness-high-fill theme" style="font-size: 4rem;"></i>
</div>



<div  id="containment">

    <?php



    if(isset($_POST['submit-btn'])){

        $fileName = basename($_FILES["img"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES['img']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));

        }
        if(!empty($_POST['title']) and !empty($_POST['bodyy']) ){

                 //   $query = "insert into item (item_id, name, animal, type, category, price, specification, quantity, details, item_image) values ('" . $_POST['id'] . "', '" . $_POST['name'] . "', '" . $_POST['animal'] . "', '" . $_POST['type'] . "', '" . $_POST['category'] . "', '" . $_POST['age'] . "', '" . $_POST['specification'] . "', '" . $_POST['quantity'] . "', '" . $_POST['about'] . "', '" . $imgContent . "');";
                    $query = "INSERT INTO `home` (`homeId`, `header`, `text`,`picture`) VALUES (NULL, '". $_POST['title'] ."', '".$_POST['bodyy']."','".$imgContent."')";
                    $query_run = mysqli_query($db, $query);

        require "Notification.php";
        $Box = new msgBox();
        $Box->title="SUCCESS!";
        $Box->massage="You've updated the home successfully";
        $Box->color="green";
        $Box -> display();
                }
        else{
            require "Notification.php";
            $Box = new msgBox();
            $Box->title="SUCCESS!";
            $Box->massage="You've updated the home successfully";
            $Box->color="green";
            $Box -> display();
        }
    }
    ?>
    <div class="container ">
        <div class="row" style="margin-bottom: 70px">

        </div>
        <div class="row">
                <div class="col">
                    <img src="../Images/homePro.png" alt="" >
                </div>
            <div class="col ">
                <div class="container" style="margin: 25px">

                    <form action="#" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <span id="appId">Edit home</span>
                    </div>
                    <div class="row d-flex justify-content-center table-wrapper">
                            <div class="col">
                                <textarea id="txtArea" placeholder="Enter the title here" name="title" style="width:100%;" rows="3"></textarea>
                            </div>
                    </div>
                    <div class="row d-flex justify-content-center table-wrapper">
                        <div class="col">
                            <textarea id="txtArea" placeholder="Enter the body here" name="bodyy" style="width:100%;" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center table-wrapper">
                        <label for="img">Select the home image:</label>
                        <input type="file" id="img" name="img" style="width: 95%" accept="image/*"><br>
                    </div>
                    <div class="row d-flex justify-content-center table-wrapper " >
                            <button id="submit-btn" type="submit" name="submit-btn" style="width: 95%; margin: 5px;">Submit</button>
                    </div>
                    </form>

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



<scrip src="../node_modules/jquery/dist/jquery.slim.min.map"></scrip>
<script src = "../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>