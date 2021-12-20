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
    <nav class="navbar fixed-top navbar-expand-lg bg-white fw-bold default-size">
        <div class="container">
            <a class="navbar-brand lightgray hover-lightgreen" href="#">
                <img src="assets/images/udm_logo_300px.png" alt="udm logo" width="50" class="d-inline-block align-text-center">
                UDM Student Portal</a>
            <button class="navbar-toggler navbar-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                    <li class="nav-item mx-2">
                        <a class="nav-link active-link lightgray hover-lightgreen " aria-current="page" href="#">Home</a>
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
                        <a class="nav-link lightgray hover-lightgreen" href="#">Password</a>
                    </li>
                    <li class="nav-item mx-2">
                        <form action="queries/logout.php" class="d-flex justify-content-center align-items-center" style="height:100%;" method="POST">
                            <button class="btn-logout" name="btn-logout">logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section style="margin-top:76px;">
        <h1>hello</h1>
    </section>

</body>
<!-- scripts for bootstrap -->
<script src="bootstrap5/js/bootstrap.bundle.min.js"></script>

</html>