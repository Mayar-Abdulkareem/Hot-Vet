<?php
try {
    $db = new mysqli('localhost', 'root', '', 'hotvet');
    session_start();
} catch (Exception $e) {
    echo "No data base";
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <!--    ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- css page-->
    <!--    <link rel="stylesheet" href="../CSS/LightTemplate.css">-->
    <link rel="stylesheet" href="../CSS/ShopLight.css" id="cssPage">
    <link rel="stylesheet" href="../CSS/epet.css">

    <!-- JavaScript Page-->
    <script type="text/javascript" src="../JAVASCRIPT/Shop.js"></script>
    <!-- jquery ui -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script rel="stylesheet" src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script rel="stylesheet" src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
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
                document.getElementById("cssPage").setAttribute("href", "../CSS/ShopDark.css");
            } else {

                document.getElementById("cssPage").setAttribute("href", "../CSS/ShopLight.css");
            }
        }
        function swapStyleSheet() {
            let element = document.body;
            element.classList.toggle("dark-mode");

            let theme = localStorage.getItem("theme");
            if (theme && theme === "dark-mode") {
                localStorage.setItem("theme", "light-mode");
                document.getElementById("cssPage").setAttribute("href", "../CSS/ShopLight.css");
            } else {
                localStorage.setItem("theme", "dark-mode");
                document.getElementById("cssPage").setAttribute("href", "../CSS/ShopDark.css");
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
<div class="header">
    <!-- Header Statement -->
    <div class="container p-0 w-50" style="margin: 15vh; margin-left: 25%">
        <form method="post" enctype="multipart/form-data">
            <div id="lo" style="text-align: center; margin: 4vh; padding: 2vh; border: .3vh solid #099aac; border-radius: 10%;">
                <input type='text' class='input-field w-75' placeholder='ID' name="id" required>
                <input type='text' class='input-field w-75' placeholder='Name' name="name" required>
                <input type='text' class='input-field w-75' placeholder='Animal' name="animal" required>
                <input type='text' class='input-field w-75' placeholder='Type' name="type" required>
                <input type='text' class='input-field w-75' placeholder='Category' name="category" required>
                <label id="labelagerange" for="ageRange"
                       class="form-label d-flex justify-content-center">Price: </label>
                <input name="age" id="ageRange" type="range" value="150" min="1" max="300"
                       oninput="this.nextElementSibling.value = this.value">
                <output class="outputagerange">150</output>
                <input type='text' class='input-field w-75' placeholder='Specification' name="specification" required>
                <input type='text' class='input-field w-75' placeholder='Quantity' name="quantity" required><br>
                <label for="about">Item details: </label></p>
                <textarea id="about" name="about" rows="4" cols="50"></textarea><br>
                <label for="img">Select item's image:</label>
                <input type="file" id="img" name="img" accept="image/*"><br><br><br>
                <input type="submit" class="btn" name="add" value="add">
            </div>
        </form>
    </div>
    <!--    add new item-->
    <?php
    if (isset($_POST['add'])) {
        $fileName = basename($_FILES["img"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

// Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES['img']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));
            $query = "insert into item (`item_id`, `name`, `animal`, `type`, `category`, `price`, `specification`, `quantity`, `details`, `item_image`) values ('" . $_POST['id'] . "', '" . $_POST['name'] . "', '" . $_POST['animal'] . "', '" . $_POST['type'] . "', '" . $_POST['category'] . "', '" . $_POST['age'] . "', '" . $_POST['specification'] . "', '" . $_POST['quantity'] . "', '" . $_POST['about'] . "', '" . $imgContent . "');";
            $query_run = mysqli_query($db, $query);
        }
    }
    ?>
    <!--    update item-->
    <?php
    if (isset($_POST['add1'])) {
        $query = "UPDATE `item` SET `item_ID` = '" . $_POST['id1'] . "', `name` = '" . $_POST['name1'] . "', `price` = '" . $_POST['age1'] . "', `quantity` = '" . $_POST['quantity1'] . "', `details` = '" . $_POST['about1'] . "' WHERE `item`.`item_ID` =" . $_POST['id1'] . ";";
        $query_run = mysqli_query($db, $query);

    }
    ?>
    <!--add to cart-->
    <?php
    if (isset($_POST['addtocart'])) {

        $item_id = $_POST['addtocart'];
        if (!isset($_SESSION['userID'])) {
            require "Notification.php";
            $Box = new msgBox();
            $Box->title = "Not Allowed!";
            $Box->massage = "You need to log in first!";
            $Box->color = "red";
            $Box->display();
        } else {

            $query = "SELECT specification, price FROM item where item.item_id = " . $item_id;
            $query_run = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($query_run);
            if ($row ['specification'] == 'size') {
                $pricet = $row['price'] * $_POST['sizeselect'];
                $query = "UPDATE `cart` SET `price` = `cart`.`price` + " . $pricet . " WHERE `cart`.`id` = " . $_SESSION['cartID'] . ";";
                $query_run = mysqli_query($db, $query);
                $query = "SELECT quantity FROM receipt where item_id =" . $item_id . " and specification = '" . $_POST['sizeselect'] . "' and cart_id = " . $_SESSION['cartID'];
                $query_run = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($query_run);
                if (!isset($row['quantity'])) {
                    $query = "INSERT INTO `receipt` (`cart_id`, `item_id`, `quantity`, `Specification`) VALUES ('" . $_SESSION['cartID'] . "', '" . $item_id . "','1', '" . $_POST['sizeselect'] . "');";
                } else {
                    $row['quantity'] = $row['quantity'] + 1;
                    $query = "UPDATE `receipt` SET `quantity` = '" . $row['quantity'] . "' WHERE `receipt`.`cart_id` = " . $_SESSION['cartID'] . " AND `receipt`.`item_id` = " . $item_id . " AND `receipt`.`specification` = " . $_POST['sizeselect'] . ";";
                }
                $query_run = mysqli_query($db, $query);
                $_SESSION['ncartitems'] = $_SESSION['ncartitems'] + 1;
                $query = 'UPDATE item SET quantity = quantity - 1 WHERE item_id = ' . $item_id . ";";
                $query_run = mysqli_query($db, $query);
                require "Notification.php";
                $Box = new msgBox();
                $Box->title = "Success!";
                $Box->massage = "Item added to your cart successfully!";
                $Box->color = "lightgreen";
                $Box->display();
            } else {
                if ($_POST['itemcolor'] == 'non') {
                    require "Notification.php";
                    $Box = new msgBox();
                    $Box->title = "Failed!";
                    $Box->massage = "Choose your item's color please!";
                    $Box->color = "orange";
                    $Box->display();
                } else {
                    $pricet = $row['price'];
                    $query = "UPDATE `cart` SET `price` = `cart`.`price` + " . $pricet . " WHERE `cart`.`id` = " . $_SESSION['cartID'] . ";";
                    $query_run = mysqli_query($db, $query);
                    $query = "SELECT quantity FROM receipt where item_id =" . $item_id . " and specification = '" . $_POST['itemcolor'] . "' and cart_id = " . $_SESSION['cartID'];
                    $query_run = mysqli_query($db, $query);
                    $row = mysqli_fetch_assoc($query_run);
                    if (!isset($row['quantity'])) {
                        $query = "INSERT INTO `receipt` (`cart_id`, `item_id`, `quantity`, `Specification`) VALUES ('" . $_SESSION['cartID'] . "', '" . $item_id . "','1', '" . $_POST['itemcolor'] . "');";
                    } else {
                        $row['quantity'] = $row['quantity'] + 1;
                        $query = "UPDATE `receipt` SET `quantity` = '" . $row['quantity'] . "' WHERE `receipt`.`cart_id` = " . $_SESSION['cartID'] . " AND `receipt`.`item_id` = " . $item_id . " AND `receipt`.`specification` = '" . $_POST['itemcolor'] . "';";
                    }
                    $query_run = mysqli_query($db, $query);
                    $_SESSION['ncartitems'] = $_SESSION['ncartitems'] + 1;
                    $query = 'UPDATE item SET quantity = quantity - 1 WHERE item_id = ' . $item_id . ";";
                    $query_run = mysqli_query($db, $query);
                    require "Notification.php";
                    $Box = new msgBox();
                    $Box->title = "Success!";
                    $Box->massage = "Item added to your cart successfully!";
                    $Box->color = "lightgreen";
                    $Box->display();
                }
            }
            ?>
            <?php
        }
    } ?>
    <!--    details-->
    <?php
    if (isset($_POST['itemdetails'])) {
        $item_id = $_POST['itemdetails'];
        $query = "SELECT item_id, name, animal, category, price, quantity, specification, item_image, details, type FROM item where item.item_id =" . $item_id . " ;";
        $query_run = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($query_run);

        ?>
        <div id="lo2" style=" margin: 4vh; padding: 2vh; border: 1vh solid #099aac">
            <?php
            echo '<img style="float: left; margin-right: 2vh; width:30vh; height:30vh" src="data:image/jpg;base64,' . base64_encode(($row['item_image'])) . '" />';
            ?>
            <form method="post" style="text-align: center" enctype="multipart/form-data">
                <input type='text' class='input-field w-75' value='<?php echo $row['item_id']; ?>' name="id1"
                       required>
                <input type='text' class='input-field w-75' value='<?php echo $row['name']; ?>' name="name1"
                       required>
                <input type='text' class='input-field w-75' value='<?php echo $row['animal']; ?>' name="animal1"
                       required>
                <input type='text' class='input-field w-75' value='<?php echo $row['type']; ?>' name="type1"
                       required>
                <input type='text' class='input-field w-75' value='<?php echo $row['category']; ?>'
                       name="category1" required>
<!--                <label id="labelagerange1" for="ageRange"-->
<!--                       class="form-label d-flex ">Price: </label>-->
                <input name="age1" id="ageRange" type="range" value="<?php echo $row['price']; ?>" min="1" max="300"
                       oninput="this.nextElementSibling.value = this.value">
                <output class="outputagerange1"><?php echo $row['price']; ?>$</output><br>
                <input type='text' class='input-field w-75' value='<?php echo $row['specification']; ?>'
                       name="specification1" required>
                <input type='text' class='input-field w-75' value='<?php echo $row['quantity']; ?>'
                       name="quantity1" required><br>
                <label for="about">Item details: </label></p>
                <textarea id="about" name="about1" rows="4" cols="50"><?php echo $row['details']; ?></textarea><br>
                <br><br><br>
                <input type="submit" class="btn" name="add1" value="Update">
            </form>
        </div>
    <?php } ?>
    <?php
    if (isset($_POST['searchitembutton'])) {
        if (!empty($_POST['searchbox'])) {
            $item_id = $_POST['searchbox'];
            $query = "SELECT item_id, name, animal, category, price, quantity, specification, item_image, details, type FROM item where item.name = '" . $_POST['searchbox'] . "';";
            $query_run = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($query_run);
            $check = mysqli_num_rows($query_run) > 0;
            if ($check) {
                ?>
                <div style="background-color: #f1f1f1; margin: 4vh; padding: 2vh; border: 1vh solid #099aac">
                    <?php
                    echo '<img style="float: left; margin-right: 2vh; width:30vh; height:30vh" src="data:image/jpg;base64,' . base64_encode(($row['item_image'])) . '" />';
                    ?>
                    <h3> <?php echo ucwords($row['name']) ?> </h3>
                    <h5>For: <?php echo ucwords($row['animal']) ?>s </h5>
                    <h5> Item's type: <?php echo ucwords($row['type']) ?> - <?php echo ucwords($row['category']) ?>
                        - </h5>
                    <p> Price: <?php echo $row['price'] ?>$ </p>
                    <p> <?php echo $row['details'] ?> </p>

                </div>
            <?php } else { ?>
                <?php
                require "Notification.php";
                $Box = new msgBox();
                $Box->title = "Not Found!";
                $Box->massage = "Item Requested Not Found";
                $Box->color = "red";
                $Box->display();
                ?>
                <?php

            }
        }
    } ?>

    <!--Search Bar-->
    <div class="d-flex flex-row align-content-center d-flex justify-content-center mt-5">
        <div class="p-2 filtericon"><span onclick="openNav();">
            <i class="bi bi-filter"></i></span></div>
        <div class="p-2">
            <form method="post" class="input-group">
                <div class="input-group rounded ">
                    <input type="search" name="searchbox" class="form-control rounded searchbox" placeholder="Search"
                           aria-label="Search"
                           aria-describedby="search-addon"/>

                    <!--                    <span name="searchitem" class="input-group-text border-0" id="search-addon">-->
                    <button id="searchicon" name="searchitembutton" type="submit" style="width:8vh; border:0">
                        <i class="bi bi-search"></i>
                    </button>
                    <!--                </span>-->
            </form>
        </div>
    </div>
    <div class="p-2"></div>
</div>
</div>


<!--Items Sections-->
<!--Food Items-->
<fieldset class="p-5 ml-2">
    <legend class="float-none w-auto p-2">Food</legend>
    <?php if (isset($_POST['filter'])) {
        if (!empty($_POST['Food1']) || !empty($_POST['Food2']) || !empty($_POST['Food3']) || !empty($_POST['Food4'])) {
            $filtersql = 1;
            $query = "SELECT item_id, name, animal, category, price, quantity, specification, item_image, details, type FROM `item` WHERE (";
            $temp_before = 0;
            if (!empty($_POST['Food1'])) {
                $temp_before = 1;
                $query = $query . 'category = "dry food"';
            }
            if (!empty($_POST['Food2'])) {
                if ($temp_before > 0)
                    $query = $query . " or ";
                $query = $query . 'category = "wet food"';
                $temp_before = 1;
            }
            if (!empty($_POST['Food3'])) {
                if ($temp_before > 0)
                    $query = $query . " or ";
                $query = $query . 'category = "Dehydrated Food"';
                $temp_before = 1;
            }
            if (!empty($_POST['Food4'])) {
                if ($temp_before > 0)
                    $query = $query . " or ";
                $query = $query . 'category = "Freeze Dried Food"';
                $temp_before = 1;
            }
            if ($temp_before > 0)
                $query = $query . ')';
        }
        {

            if (!empty($_POST['Pet1']) | !empty($_POST['Pet2'])) {
                $temp_before = 0;
                if (isset($filtersql)) {
                    $query = $query . 'and (';
                }
                if (isset($_POST['Pet1'])) {
                    if (!isset($filtersql)) {
                        $petsfiltered = 1;
                        $query = "SELECT item_id, name, animal, category, price, quantity, specification, item_image, details, type FROM item where item.type = 'food' and (animal = 'cat'";

                    } else {
                        $query = $query . 'animal = "cat"';
                    }
                    $temp_before = 1;

                }
                if (isset($_POST['Pet2'])) {

                    if (!isset($filtersql)) {
                        $petsfiltered = 1;
                        $query = "SELECT item_id, name, animal, category, price, quantity, specification, item_image, details, type FROM item where item.type = 'food' and (";

                    } else if ($temp_before > 0)
                        $query = $query . " or ";

                    $query = $query . 'animal = "dog"';

                }
                $query = $query . ')';
                echo $query;
            }

        }

    } ?>
    <div class=" container container-fluid">
        <?php
        if (!isset($filtersql) && !isset($petsfiltered)) {
            $query = "SELECT item_id, name, animal, category, price, quantity, specification, item_image, details, type FROM item where item.type = 'food'";
        }
        $query = $query . ' and item.quantity > 0';
        $query_run = mysqli_query($db, $query);
        $check = mysqli_num_rows($query_run) > 0;
        if ($check) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                ?>

                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <?php
                            echo '<img style="width:30vh; height:30vh" src="data:image/jpg;base64,' . base64_encode(($row['item_image'])) . '" />';
                            ?>
                            <h1>
                                <?php echo ucwords($row ['category']); ?></h1>
                        </div>
                        <div class="flip-card-back">
                            <h1>
                                <?php echo ucwords($row ['category']); ?></h1>
                            <p style="height: 8vh; line-break: auto"><?php echo $row ['name']; ?></p>
                            <form method="post">
                                <select class="form-select" name="sizeselect"
                                        onchange="changeprice(<?php echo $row ['item_id']; ?>, value, <?php echo $row ['price']; ?>)">
                                    <option value="1">Small</option>
                                    <option value="2">Medium</option>
                                    <option value="3">Large</option>
                                </select>

                                <p id="<?php echo $row ['item_id'] . "price"; ?>"
                                   style="color: black; margin-bottom: 0">
                                    Price: <?php echo $row ['price']; ?>$</p>
                                <p style="padding:0; margin:0;">


                            </form>
                            <form method="post">
                                <button name="itemdetails" type="submit" class="itemdetails"
                                        value="<?php echo $row ['item_id']; ?>"
                                        style="background-color: transparent; border: 0;margin-top: .5vh; margin-left: 50%; padding:0;">
                                    <i class="bi bi-three-dots details"></i>
                                </button>
                            </form>
                            </p>

                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "No items left";
        }
        ?>

    </div>
</fieldset>
<!--Bowls Items-->
<fieldset class="p-5 ml-2">
    <legend class="float-none w-auto p-2">Bowls</legend>
    <?php if (isset($_POST['filter'])) {
        if (!empty($_POST['Bowls1']) || !empty($_POST['Bowls2']) || !empty($_POST['Bowls3'])) {
            $filtersql2 = 1;
            $query = "SELECT item_id, name, animal, category, price, quantity, specification, item_image, details, type FROM `item` WHERE (";
            $temp_before = 0;
            if (!empty($_POST['Bowls1'])) {
                $temp_before = 1;
                $query = $query . 'category = "Dishes"';
            }
            if (!empty($_POST['Bowls2'])) {
                if ($temp_before > 0)
                    $query = $query . " or ";
                $query = $query . 'category = "Feeders"';
                $temp_before = 1;
            }
            if (!empty($_POST['Bowls3'])) {
                if ($temp_before > 0)
                    $query = $query . " or ";
                $query = $query . 'category = "Waterers"';
                $temp_before = 1;
            }
            if ($temp_before > 0)
                $query = $query . ')';
        }
        {
            if (!empty($_POST['Pet1']) | !empty($_POST['Pet2'])) {
                $temp_before = 0;
                if (isset($filtersql2)) {
                    $query = $query . 'and (';
                }
                if (isset($_POST['Pet1'])) {
                    if (!isset($filtersql2)) {
                        $petsfiltered = 1;
                        $query = "SELECT item_id, name, animal, category, price, quantity, specification, item_image, details, type FROM item where item.type = 'bowls' and (animal = 'cat'";

                    } else {
                        $query = $query . 'animal = "cat"';
                    }
                    $temp_before = 1;

                }
                if (isset($_POST['Pet2'])) {

                    if (!isset($filtersql2)) {
                        $petsfiltered = 1;
                        $query = "SELECT item_id, name, animal, category, price, quantity, specification, item_image, details, type FROM item where item.type = 'bowls' and (";

                    } else if ($temp_before > 0)
                        $query = $query . " or ";

                    $query = $query . 'animal = "dog"';

                }
                $query = $query . ')';
                echo $query;
            }

        }

    } ?>
    <div class=" container container-fluid">
        <?php
        if (!isset($filtersql2) && !isset($petsfiltered)) {
            $query = "SELECT item_id, name, animal, category, price, quantity, specification, item_image, details, type FROM item where item.type = 'bowls'";
        }
        $query = $query . ' and item.quantity > 0';
        $query_run = mysqli_query($db, $query);
        $check = mysqli_num_rows($query_run) > 0;
        if ($check) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                ?>

                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <?php
                            echo '<img style="width:30vh; height:30vh" src="data:image/jpg;base64,' . base64_encode(($row['item_image'])) . '" />';
                            ?>
                            <h1>
                                <?php echo ucwords($row ['category']); ?></h1>
                        </div>
                        <div class="flip-card-back">
                            <h1>
                                <?php echo ucwords($row ['category']); ?></h1>
                            <p style="height: 8vh; line-break: auto"><?php echo $row ['name']; ?></p>
                            <form method="post">
                                <p>
                                    <button value="white" type="button" class="btn" style="background-color: white;"
                                            name="<?php echo $row ['item_id']; ?>+'white'"
                                            onclick="changecolor(<?php echo $row ['item_id']; ?>, 'white')"></button>
                                    <button value="pink" type="button" class="btn" style="background-color: pink;"
                                            name="<?php echo $row ['item_id']; ?>+'pink'"
                                            onclick="changecolor(<?php echo $row ['item_id']; ?>, 'pink')"></button>
                                    <button value="blue" type="button" class="btn"
                                            style="background-color: cornflowerblue;"
                                            name="<?php echo $row ['item_id']; ?>+'blue'"
                                            onclick="changecolor(<?php echo $row ['item_id']; ?>, 'blue')"></button>
                                    <input id="<?php echo $row ['item_id'] . "color"; ?>" type="text"
                                           name="itemcolor" value="non"
                                           style="display:none; visibility: hidden;">
                                </p>
                                <p id="<?php echo $row ['item_id'] . "price"; ?>"
                                   style="color: black; margin-bottom: 0">
                                    Price: <?php echo $row ['price']; ?>$</p>
                                <p style="padding:0; margin:0;">

                            </form>
                            <form method="post">
                                <button name="itemdetails" type="submit" class="itemdetails"
                                        value="<?php echo $row ['item_id']; ?>"
                                        style="background-color: transparent; border: 0;margin-top: .5vh; margin-left: 50%; padding:0;">
                                    <i class="bi bi-three-dots details"></i>
                                </button>
                            </form>
                            </p>

                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "No items left";
        }
        ?>

    </div>
</fieldset>
<!--Toys Items-->
<fieldset class="p-5 ml-2">
    <legend class="float-none w-auto p-2">Toys</legend>
    <?php if (isset($_POST['filter'])) {
        if (!empty($_POST['Toys1']) || !empty($_POST['Toys2']) || !empty($_POST['Toys3']) || !empty($_POST['Toys4'])) {
            $filtersql3 = 1;
            $query = "SELECT item_id, name, animal, category, price, quantity, specification, item_image, details, type FROM `item` WHERE (";
            $temp_before = 0;
            if (!empty($_POST['Toys1'])) {
                $temp_before = 1;
                $query = $query . 'category = "Balls"';
            }
            if (!empty($_POST['Toys2'])) {
                if ($temp_before > 0)
                    $query = $query . " or ";
                $query = $query . 'category = "Chew Toys"';
                $temp_before = 1;
            }
            if (!empty($_POST['Toys3'])) {
                if ($temp_before > 0)
                    $query = $query . " or ";
                $query = $query . 'category = "Ropes"';
                $temp_before = 1;
            }
            if (!empty($_POST['Toys4'])) {
                if ($temp_before > 0)
                    $query = $query . " or ";
                $query = $query . 'category = "Plush Toys"';
                $temp_before = 1;
            }
            if ($temp_before > 0)
                $query = $query . ')';
        }
        {

            if (!empty($_POST['Pet1']) | !empty($_POST['Pet2'])) {
                $temp_before = 0;
                if (isset($filtersql3)) {
                    $query = $query . 'and (';
                }
                if (isset($_POST['Pet1'])) {
                    if (!isset($filtersql3)) {
                        $petsfiltered = 1;
                        $query = "SELECT item_id, name, animal, category, price, quantity, specification, item_image, details, type FROM item where item.type = 'toys' and (animal = 'cat'";

                    } else {
                        $query = $query . 'animal = "cat"';
                    }
                    $temp_before = 1;

                }
                if (isset($_POST['Pet2'])) {

                    if (!isset($filtersql3)) {
                        $petsfiltered = 1;
                        $query = "SELECT item_id, name, animal, category, price, quantity, specification, item_image, details, type FROM item where item.type = 'toys' and (";

                    } else if ($temp_before > 0)
                        $query = $query . " or ";

                    $query = $query . 'animal = "dog"';

                }
                $query = $query . ')';
                echo $query;
            }

        }

    } ?>
    <div class=" container container-fluid">
        <?php
        if (!isset($filtersql3) && !isset($petsfiltered)) {
            $query = "SELECT item_id, name, animal, category, price, quantity, specification, item_image, details, type FROM item where item.type = 'toys'";
        }
        $query = $query . ' and item.quantity > 0';
        $query_run = mysqli_query($db, $query);
        $check = mysqli_num_rows($query_run) > 0;
        if ($check) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                ?>

                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <?php
                            echo '<img style="width:30vh; height:30vh" src="data:image/jpg;base64,' . base64_encode(($row['item_image'])) . '" />';
                            ?>
                            <h1>
                                <?php echo ucwords($row ['category']); ?></h1>
                        </div>
                        <div class="flip-card-back">
                            <h1>
                                <?php echo ucwords($row ['category']); ?></h1>
                            <p style="height: 8vh; line-break: auto"><?php echo $row ['name']; ?></p>

                            <p id="<?php echo $row ['item_id'] . "price"; ?>" style="color: black; margin-bottom: 0">
                                Price: <?php echo $row ['price']; ?>$</p>
                            <p style="padding:0; margin:0;">
                            <form method="post">
                                <button type="submit" name="addtocart" class="btn btn-default"
                                        value="<?php echo $row ['item_id']; ?>">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </form>
                            <form method="post">
                                <button name="itemdetails" type="submit" class="itemdetails"
                                        value="<?php echo $row ['item_id']; ?>"
                                        style="background-color: transparent; border: 0;margin-top: .5vh; margin-left: 50%; padding:0;">
                                    <i class="bi bi-three-dots details"></i>
                                </button>
                            </form>
                            </p>

                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "No items left";
        }
        ?>

    </div>
</fieldset>
<!--Collars and Tags Items-->
<fieldset class="p-5 ml-2">
    <legend class="float-none w-auto p-2">Collars & Tags</legend>
    <?php if (isset($_POST['filter'])) {
        if (!empty($_POST['Collars1']) || !empty($_POST['Collars2']) || !empty($_POST['Collars3']) || !empty($_POST['Collars4'])) {
            $filtersql4 = 1;
            $query = "SELECT item_id, name, animal, category, price, quantity, specification, item_image, details, type FROM `item` WHERE (";
            $temp_before = 0;
            if (!empty($_POST['Collars1'])) {
                $temp_before = 1;
                $query = $query . 'category = "Accessories"';
            }
            if (!empty($_POST['Collars2'])) {
                if ($temp_before > 0)
                    $query = $query . " or ";
                $query = $query . 'category = "Collars"';
                $temp_before = 1;
            }
            if (!empty($_POST['Collars3'])) {
                if ($temp_before > 0)
                    $query = $query . " or ";
                $query = $query . 'category = "Leashes"';
                $temp_before = 1;
            }
            if (!empty($_POST['Collars4'])) {
                if ($temp_before > 0)
                    $query = $query . " or ";
                $query = $query . 'category = "Harness"';
                $temp_before = 1;
            }
            if ($temp_before > 0)
                $query = $query . ')';
        }
        {

            if (!empty($_POST['Pet1']) | !empty($_POST['Pet2'])) {
                $temp_before = 0;
                if (isset($filtersql4)) {
                    $query = $query . 'and (';
                }
                if (isset($_POST['Pet1'])) {
                    if (!isset($filtersql4)) {
                        $petsfiltered = 1;
                        $query = "SELECT item_id, name, animal, category, price, quantity, specification, item_image, details, type FROM item where item.type = 'collars' and (animal = 'cat'";

                    } else {
                        $query = $query . 'animal = "cat"';
                    }
                    $temp_before = 1;

                }
                if (isset($_POST['Pet2'])) {

                    if (!isset($filtersql4)) {
                        $petsfiltered = 1;
                        $query = "SELECT item_id, name, animal, category, price, quantity, specification, item_image, details, type FROM item where item.type = 'collars' and (";

                    } else if ($temp_before > 0)
                        $query = $query . " or ";

                    $query = $query . 'animal = "dog"';

                }
                $query = $query . ')';
                echo $query;
            }

        }

    } ?>
    <div class=" container container-fluid">
        <?php
        if (!isset($filtersql4) && !isset($petsfiltered)) {
            $query = "SELECT item_id, name, animal, category, price, quantity, specification, item_image, details, type FROM item where item.type = 'collars'";
        }
        $query = $query . ' and item.quantity > 0';
        $query_run = mysqli_query($db, $query);
        $check = mysqli_num_rows($query_run) > 0;
        if ($check) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                ?>

                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <?php
                            echo '<img style="width:30vh; height:30vh" src="data:image/jpg;base64,' . base64_encode(($row['item_image'])) . '" />';
                            ?>
                            <h1>
                                <?php echo ucwords($row ['category']); ?></h1>
                        </div>
                        <div class="flip-card-back">
                            <h1>
                                <?php echo ucwords($row ['category']); ?></h1>
                            <p style="height: 8vh; line-break: auto"><?php echo $row ['name']; ?></p>

                            <p id="<?php echo $row ['item_id'] . "price"; ?>" style="color: black; margin-bottom: 0">
                                Price: <?php echo $row ['price']; ?>$</p>
                            <p style="padding:0; margin:0;">
                            <form method="post">
                                <button type="submit" name="addtocart" class="btn btn-default"
                                        value="<?php echo $row ['item_id']; ?>">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </form>
                            <form method="post">
                                <button name="itemdetails" type="submit" class="itemdetails"
                                        value="<?php echo $row ['item_id']; ?>"
                                        style="background-color: transparent; border: 0;margin-top: .5vh; margin-left: 50%; padding:0;">
                                    <i class="bi bi-three-dots details"></i>
                                </button>
                            </form>
                            </p>

                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "No items left";
        }
        ?>

    </div>
</fieldset>
</body>

<!--Filtering Menu-->
<div id="mySidenav" class="sidenav">

    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <p>Pets</p>
    <div class="filteringMenu">
        <form method="post">
            <input type="checkbox" id="Pet1" name="Pet1"
                   value="Cat" <?php if (isset($_POST['Pet1'])) { ?> checked<?php } ?> >
            <label for="Pet1"> Cat</label><br>
            <input type="checkbox" id="Pet2" name="Pet2"
                   value="Dog" <?php if (isset($_POST['Pet2'])) { ?> checked<?php } ?> >
            <label for="Pet2"> Dog</label><br>

    </div>
    <p>Food</p>
    <div class="filteringMenu">

        <input type="checkbox" id="Food1" name="Food1"
               value="DryFood" <?php if (isset($_POST['Food1'])) { ?> checked<?php } ?> >
        <label for="Food1"> Dry Food</label><br>
        <input type="checkbox" id="Food2" name="Food2"
               value="WetFood" <?php if (isset($_POST['Food2'])) { ?> checked<?php } ?> >
        <label for="Food2"> Wet Food</label><br>
        <input type="checkbox" id="Food3" name="Food3"
               value="DehydratedFood" <?php if (isset($_POST['Food3'])) { ?> checked<?php } ?> >
        <label for="Food3"> Dehydrated Food</label><br>
        <input type="checkbox" id="Food4" name="Food4"
               value="FreezeDriedFood" <?php if (isset($_POST['Food4'])) { ?> checked<?php } ?> >
        <label for="Food4"> Freeze Dried Food</label>
    </div>
    <p>Bowls</p>
    <div class="filteringMenu">
        <input type="checkbox" id="Bowls1" name="Bowls1"
               value="Dishes" <?php if (isset($_POST['Bowls1'])) { ?> checked<?php } ?> >
        <label for="Bowls1"> Dishes</label><br>
        <input type="checkbox" id="Bowls2" name="Bowls2"
               value="Feeders" <?php if (isset($_POST['Bowls2'])) { ?> checked<?php } ?> >
        <label for="Bowls2"> Feeders</label><br>
        <input type="checkbox" id="Bowls3" name="Bowls3"
               value="Waterers" <?php if (isset($_POST['Bowls3'])) { ?> checked<?php } ?> >
        <label for="Bowls3"> Waterers</label><br>
    </div>
    <p>Toys</p>
    <div class="filteringMenu">
        <input type="checkbox" id="Toys1" name="Toys1"
               value="Balls" <?php if (isset($_POST['Toys1'])) { ?> checked<?php } ?> >
        <label for="Toys1"> Balls</label><br>
        <input type="checkbox" id="Toys2" name="Toys2"
               value="ChewToys" <?php if (isset($_POST['Toys2'])) { ?> checked<?php } ?> >
        <label for="Toys2"> Chew Toys</label><br>
        <input type="checkbox" id="Toys3" name="Toys3"
               value="Ropes" <?php if (isset($_POST['Toys3'])) { ?> checked<?php } ?> >
        <label for="Toys3"> Ropes</label><br>
        <input type="checkbox" id="Toys4" name="Toys4"
               value="PlushToys" <?php if (isset($_POST['Toys4'])) { ?> checked<?php } ?> >
        <label for="Toys4"> Plush Toys</label><br>
    </div>
    <p>Collars & Tags</p>
    <div class="filteringMenu">
        <input type="checkbox" id="Collars1" name="Collars1"
               value="Accessories" <?php if (isset($_POST['Collars1'])) { ?> checked<?php } ?> >
        <label for="Collars1"> Accessories</label><br>
        <input type="checkbox" id="Collars2" name="Collars2"
               value="Collars" <?php if (isset($_POST['Collars2'])) { ?> checked<?php } ?> >
        <label for="Collars2"> Collars</label><br>
        <input type="checkbox" id="Collars3" name="Collars3"
               value="Leashes" <?php if (isset($_POST['Collars3'])) { ?> checked<?php } ?> >
        <label for="Collars3"> Leashes</label><br>
        <input type="checkbox" id="Collars4" name="Collars4"
               value="Harness" <?php if (isset($_POST['Collars4'])) { ?> checked<?php } ?> >
        <label for="Collars4"> Harness</label><br>
    </div>

    <button type="submit" name="filter" class="btn btn-outline-secondary w-100 btn-block">Filter</button>
    </form>
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
<!--PHP CODE-->

<!--<script src="../node_modules/jquery/dist/jquery.slim.min.map"></script>-->
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>