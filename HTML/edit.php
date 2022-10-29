<?php
try {
    $db = new mysqli('localhost', 'root', '', 'hotvet');
    session_start();
} catch (Exception $e) {
    echo "No data base";
}
?>
?>
<?php
//if(isset($_POST['chang']) and isset($_POST['First']) and isset($_POST['Last']) and isset($_POST['Address']) and isset($_POST['phone'])
//    and isset($_POST['Email']) ) {
//
//    $first = $_POST['First'];
//    $final = $_POST['Last'];
//    $addres = $_POST['Address'];
//    $phon = $_POST['phone'];
//    $email = $_POST['Email'];
//
//
//    $sql1 = "UPDATE `user` SET  `fname`='".$first."' ,`lname`='".$final."',`Address`='".$addres."',`email`='".$email."'
//    ,`phone` = '".$phon."'  WHERE  `userID` = ".$userID." ;";
//
//    if ($db->query($sql1) == TRUE) {
//        require "Notification.php";
//        $Box = new msgBox();
//        $Box->title="SUCCESS!";
//        $Box->massage="You've updated your field successfully";
//        $Box->color="green";
//        $Box -> display();
//    } else {
//        require "Notification.php";
//        $Box = new msgBox();
//        $Box->title="ERROR!";
//        $Box->massage="sql query error";
//        $Box->color="#f44336";
//        $Box -> display();
//
//    }
//}
//elseif((empty($_POST['First']) or empty($_POST['Last']) or empty($_POST['Address'])  or empty($_POST['phone'])
//        or empty($_POST['Email']) ) and isset($_POST['chang']) ){
//
//    require "Notification.php";
//    $Box = new msgBox();
//    $Box->title="ERROR!";
//    $Box->massage="You've to fill all the field";
//    $Box->color="#f44336";
//    $Box -> display();
//}
//
//?>

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
    <link rel="stylesheet" href="../CSS/ProfileLight.css" id="cssPage">
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
                document.getElementById("cssPage").setAttribute("href", "../CSS/ProfileDark.css");
            } else {
                document.getElementById("template").setAttribute("href","../CSS/LightTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/ProfileLight.css");
            }
        }
        function swapStyleSheet() {
            let element = document.body;
            element.classList.toggle("dark-mode");

            let theme = localStorage.getItem("theme");
            if (theme && theme === "dark-mode") {
                localStorage.setItem("theme", "light-mode");
                document.getElementById("template").setAttribute("href","../CSS/LightTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/ProfileLight.css");
            } else {
                localStorage.setItem("theme", "dark-mode");
                document.getElementById("template").setAttribute("href", "../CSS/DarkTemplate.css");
                document.getElementById("cssPage").setAttribute("href", "../CSS/ProfileDark.css");
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





<div  id="containment" class="container-fluid" style="margin-top: 100px; margin-bottom: 50px ">

    <div id="draggable" class="ui-widget-content theme" onclick="swapStyleSheet();">
        <i id="brightness" class="bi bi-brightness-high-fill theme" style="font-size: 4rem;"></i>
    </div>


    <?php




    if(isset($_POST['add'])){

        $fileName = basename($_FILES["img"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES['img']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));

        }
        if(!empty($_POST['fName']) and !empty($_POST['lastt']) and !empty($_POST['emaill'] and !empty($_POST['passwordd']))
         and !empty($_POST['phonee']) and !empty($_POST['addresss']) and !empty($_POST['specialtyy']) and !empty($_POST['experiencee'])
        and !empty($_POST['salaryy']) and !empty($_POST['faceBook']) ){

            // get the user id
            // userID = new ID
            $sql = "SELECT userid FROM user ORDER BY userid DESC LIMIT 1;";
            $result = $db->query($sql);
            if($result->num_rows>0){
                $row = $result->fetch_assoc();
                $userID = $row['userid'];
                $userID++;
            }
            else
                $userID = 0;

           // get data

            $firstVar = $_POST['fName'];
            $finalVar = $_POST['lastt'];
            $emailVar = $_POST['emaill'];
            $PasswordVar = sha1($_POST['passwordd']);
            $phoneVar = $_POST['phonee'];
            $addressVar = $_POST['addresss'];
            $specialtyVar = $_POST['specialtyy'];
            $experienceVar = $_POST['experiencee']  ;
            $facebookVar = $_POST['faceBook'];
            $slaryVar = $_POST['salaryy'];

           // insert into user
            $sql1 = "INSERT INTO `user` (`userid`,`fname`, `lname`, `Address`, `email`, `phone`, `password`, `role`) VALUES
       ( '" . $userID . "' , '" . $firstVar . "','" . $finalVar . "','" . $addressVar . "','" . $emailVar . "'," . $phoneVar . ",'" . $PasswordVar . "',2)";

              $result = $db->query($sql1) ;
           // insert into vet
            $query = "INSERT INTO `vet` (`userid`, `fname`, `lname`, `email`, `password`, `phone`, `address`, `specialty`, `experience`, `facebook`, `salary`) VALUES                                                                                                                                    
      ('".$userID."', '".$firstVar."', '".$finalVar."', '".$emailVar."', '".$PasswordVar."', '".$phoneVar."', '".$addressVar."', '".$specialtyVar."', 
      '".$experienceVar."', '".$facebookVar."', '".$imgContent."')" ;

                $result = $db->query($query) ;
        require "Notification.php";
            $Box = new msgBox();
            $Box->title="SUCCESS!";
            $Box->massage="You've added the employee successfully";
            $Box->color="green";
            $Box -> display();

        }
        else{
            require "Notification.php";
            $Box = new msgBox();
            $Box->title="ERROR!";
            $Box->massage="You've to fill all the fields";
            $Box->color="red";
            $Box -> display();
        }


        }

    if (isset($_POST['del'])){


            $query = "DELETE FROM `user` WHERE `user`.`userid` = ".$_POST['del'];
            $result = $db->query($query);
            $query =  "DELETE FROM `vet` WHERE `vet`.`userid` =".$_POST['del'];
            $result = $db->query($query);

            require "Notification.php";
            $Box = new msgBox();
            $Box->title="SUCCESS!";
            $Box->massage="You've deleted the employee successfully";
            $Box->color="green";
            $Box -> display();

    }


    ?>

<div class="row">
    <div class="col-4">
        <img class="img-fluid" src="../Images/setting.png" alt="" >
    </div>
    <div class="col-8">
        <div class="row">
            <span id="appId">My employees </span>
        </div>
        <div class="row d-flex justify-content-center table-wrapper">
            <table class="content-table ">
                <thead>
                <tr><th>Id</th><th> Name</th><th>Email</th><th>Phone</th><th>Address</th><th>specialty</th><th>salary</th><th>Delete</th></tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM `vet`";
                $result = $db->query($query);
                for ($i=0;$i<$result->num_rows;$i++){
                    $row = $result->fetch_assoc();
                    $userid = $row['userid'];
                    $fname = $row['fname'];
                    $lname = $row['lname'];
                    $email = $row['email'];
                  //  $password = $row['password'];
                    $phone = $row['phone'];
                    $address = $row['address'];
                    $specialty = $row['specialty'];
                 //   $experience = $row['experience'];
                    $salary = $row['salary'];
                ?>
                <tr>
                    <td id="1"> <?php echo $userid ?> </td>
                    <td><?php echo $fname . " " . $lname ?></td>
                    <td><?php echo $email ?></td>
                    <td><?php echo $phone ?></td>
                    <td><?php echo $address ?></td>
                    <td><?php echo $specialty ?></td>
                    <td><?php echo $salary ?></td>
                    <td>
                        <form action="#" method="post"  enctype="multipart/form-data>
                            <button class="btn-danger small" name="del" value="<?php echo $userid; ?>" ><i class="bi bi-dash-circle"></i></button>
                        </form>
                    </td>
                </tr>
                <?php
                }
                ?>
                </tbody>
            </table>

        </div>

</div>
    <div class="row">
            <span style="text-align: center;font-size: xx-large;font-weight: bold;color: #099aac;font-family: Gotham;">
                Add new employee </span>
    </div>
    <form action="#" method="post" enctype="multipart/form-data">
    <div class="row">
        <table class="content-table">
            <thead>
            <tr><th> First name</th><th>Last name</th><th>Email</th><th>Password</th><th>Phone</th></tr>
            </thead>
            <tbody>
            <tr>
                <td><input type="text" placeholder name="fName"> </td>
                <td><input type="text" placeholder name="lastt"> </td>
                <td><input type="text" placeholder name="emaill"> </td>
                <td><input type="password" placeholder name="passwordd"> </td>
                <td><input type="number" placeholder name="phonee"> </td>

            </tr>
            </tbody>
        </table>
        <table class="content-table ">
            <thead>
            <tr><th>Address</th><th>specialty</th><th>Experience</th>
                <th>Facebook</th><th>salary</th></tr>
            </thead>
            <tbody>
            <tr>
                <td><input type="text" placeholder name="addresss"> </td>
                <td><input type="text" placeholder name="specialtyy"> </td>
                <td><input type="text" placeholder name="experiencee"> </td>
                <td><input type="text" placeholder name="faceBook"> </td>
                <td><input type="text" placeholder name="salaryy"> </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="row d-flex justify-content-center" style="margin:5px;">
        <input type="file" id="img" name="img" style="width: 20%" accept="image/*"><br>
    </div>
    <div class="row d-flex justify-content-center" style="mergin:5px;">
        <button class="btn-success" name="add" style="width: 20%"> Save</button>
    </div>
    </form>
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

</body>
</html>