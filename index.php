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
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>
    <?php include 'includes/nav.php'; ?>
    <!-- script to add style on current link -->
    <script>
        $(".announcements-link").addClass("active-link");
    </script>
    <section class="mini-profile" style="margin-top:76px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php include 'includes/connection.php';

                    $select_stmt = $conn->prepare("SELECT * FROM udm.students WHERE student_username=:uname"); //prepared selct statement
                    $select_stmt->execute(array(':uname' => $_SESSION["student_username"]));
                    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                    if ($row) {
                        $student_no = $row["student_no"];
                        $student_name = strtoupper($row["first_name"] . " " . $row["middle_name"] . " " . $row["last_name"]);
                        $course =  $row["course"];
                        $college =  $row["college"];
                        $imageURL = "uploads/" . $row["picture_filename"];
                    }
                    ?>
                    <div class="profile d-flex flex-row align-items-center justify-content-center">
                        <div>
                            <img src="<?= $imageURL ?>" alt="" width="70">
                        </div>
                        <div>
                            <p>Student No: <span><?= $student_no ?></span></p>
                            <p>Student Name: <span><?= $student_name ?></span></p>
                            <p>Course: <span><?= $course ?></span></p>
                            <p>College: <span><?= $college ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="announcements">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="card-custom gold-gradient no-border">
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