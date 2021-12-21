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
    <title>UDM Student Portal | Profile</title>
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
    <!-- navbar -->
    <?php include 'includes/nav.php' ?>
    <script>
        $(".profile-link").addClass("active-link");
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
</body>
<!-- scripts for bootstrap -->
<script src="bootstrap5/js/bootstrap.bundle.min.js"></script>

</html>