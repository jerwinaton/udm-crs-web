<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UDM Student Portal | Home</title>
    <!-- jquery -->
    <script src="jquery/jquery3.6.0.min.js"></script>
    <!-- bootstrap -->
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
    <!-- global css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- login page css only -->
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg bg-white fw-bold  default-size">
        <div class="container">
            <a class="navbar-brand lightgray hover-lightgreen" href="#">
                <img src="assets/images/udm_logo_300px.png" alt="udm logo" width="50" class="d-inline-block align-text-center">
                UDM Student Portal</a>
            <button class="navbar-toggler navbar-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse bg-white navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-end ">
                    <li class="nav-item mx-2">
                        <a class="nav-link announcements-link lightgray hover-lightgreen " aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link lightgray hover-lightgreen" href="#">View Schedule</a>
                    </li>
                    <li class="nav-item mx-2 ">
                        <a class="nav-link lightgray hover-lightgreen " aria-current="page" href="#">View Grades</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link lightgray hover-lightgreen" href="#">Profile</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link nav-link lightgray hover-lightgreen" href="#">Password</a>
                    </li>
                    <li class="nav-item mx-2">
                        <form action="queries/logout.php" class="d-flex justify-content-center align-items-center" style="height:100%;" method="POST">
                            <button class="btn-logout" name="btn-logout">logout</button>
                        </form>
                    </li>
                    <!-- script to add style on current link -->
                    <script>
                        $(".announcements-link").addClass("active-link");
                    </script>
                </ul>
            </div>
        </div>
    </nav>
    <section class="announcements" style="margin-top:76px;">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="card-custom gold">
                        <h1 class="text-center">Announcements</h1>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card-custom">
                        <h3>2021-2022 1st SEMESTER FINAL EXAMINATION - Undergraduate</h3>
                        <p>December 13-17, 2021</p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card-custom">
                        <h3>CHRISTMAS BREAK - Undergraduate</h3>
                        <p>December 20, 2021 to January 2, 2022</p>

                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card-custom">
                        <h3>ENCODING OF GRADES - Undergraduate</h3>
                        <p>December 28-29, 2021</p>

                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card-custom">
                        <h3>SEMESTRAL BREAK - Undergraduate</h3>
                        <p>January 3-8, 2022</p>

                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card-custom">
                        <h3>2021-2022 2nd SEMESTER ENROLLMENT - Undergraduate</h3>
                        <p>First Year - January 3, 2022<br />
                            Second Year - January 4, 2022<br />
                            Third Year - January 5, 2022<br />
                            Fourth/Fifth Year - January 6, 2022 <br />
                            Adding/Dropping/Changing of Subject - January 24-28, 2022</p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card-custom">
                        <h3>2021-2022 2nd SEMESTER START OF CLASSES - Undergraduate</h3>
                        <p>January 17, 2022</p>
                    </div>
                </div>







            </div>


        </div>
    </section>

</body>
<!-- scripts for bootstrap -->
<script src="bootstrap5/js/bootstrap.bundle.min.js"></script>

</html>