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
    <link rel="stylesheet" href="../CSS/epet.css">
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
<div  id="containment">
<div class="container p-0 w-50" style="margin: 15vh; margin-left: 25%" >
    <form method="post" enctype="multipart/form-data">
        <div id="lo" style="text-align: center;  margin: 4vh; padding: 2vh; border: .3vh solid #099aac; border-radius: 10%;">
            <input type='text' class='input-field w-75' placeholder='ID' name="id" required>
            <input type='text' class='input-field w-75' placeholder='Name' name="name" required>
            <input type='text' class='input-field w-75' placeholder='Type' name="type" required>
            <label id="labelagerange" for="ageRange" class="form-label d-flex justify-content-center">Age -In
                months-</label>
            <input name="age" id="ageRange" type="range" value="15" min="1" max="30"
                   oninput="this.nextElementSibling.value = this.value">
            <output class="outputagerange">15</output>
            <input type='text' class='input-field w-75' placeholder='Color' name="color" required>
            <input type='text' class='input-field w-75' placeholder='Gender' name="gender" required><br>
            <label for="about">About pet: </label></p>
            <textarea id="about" name="about" rows="4" cols="50"></textarea><br>
            <label for="img">Select pet's image:</label>
            <input type="file" id="img" name="img" accept="image/*"><br><br><br>
            <input type="submit" class="btn" name="add" value="add">
        </div>
    </form>
</div>
<?php
if (isset($_POST['add'])) {
    $fileName = basename($_FILES["img"]["name"]);
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

// Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
        $image = $_FILES['img']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        $query = "insert into pet (`id`, `name`, `type`, `age`, `color`, `gender`, `about`, `pet_image`) values ('" . $_POST['id'] . "', '" . $_POST['name'] . "', '" . $_POST['type'] . "', '" . $_POST['age'] . "', '" . $_POST['color'] . "', '" . $_POST['gender'] . "', '" . $_POST['about'] . "', '" . $imgContent . "');";
        $query_run = mysqli_query($db, $query);
    }
}
?>
<div class=" container container-fluid mt-5">
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
</body>
</html>