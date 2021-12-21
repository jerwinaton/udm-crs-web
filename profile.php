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
    <section class="edit-profile">
        <div class="container-form">
            <form action="" class="profile-form">
                <div class="row justify-content-start seperate1">
                    <div class="col-md-4 col-10">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name">
                    </div>
                    <div class="col-md-4 col-10">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name">
                    </div>
                    <div class="col-md-4 col-10">
                        <label for="last_name">Last Name</label>
                        <input class="form-control" type="text" id="last_name" name="last_name">
                    </div>
                    <div class="col-md-4">
                        <label for="lrn">LRN</label>
                        <input class="form-control" type="text" id="lrn" name="lrn">
                    </div>
                    <div class="col-md-2">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" class="form-control">
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="birthdate">Birthdate</label>
                        <input class="form-control" type="date" id="birthdate" name="birthdate">
                    </div>
                    <div class="col-md-3">
                        <label for="birthplace">Birthplace</label>
                        <input class="form-control" type="birthplace" id="birthplace" name="birthplace">
                    </div>
                </div>
                <!-- seperate -->
                <div class="row justify-content-start seperate2">
                    <div class="col-md-4 col-10">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="col-md-4 col-10">
                        <label for="district">District</label>
                        <select id="district" name="district" class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-10">
                        <label for="town">Town</label>
                        <select id="town" name="town" class="form-control">
                            <option>Binondo</option>
                            <option>Ermita</option>
                            <option>Intramuros</option>
                            <option>Malate</option>
                            <option>Paco</option>
                            <option>Pandacan</option>
                            <option>Port Area</option>
                            <option>Quiapo</option>
                            <option>Sampaloc</option>
                            <option>San Andres</option>
                            <option>San Miguel</option>
                            <option>San Nicolas</option>
                            <option>Santa Ana</option>
                            <option>Santa Cruz</option>
                            <option>Santa Mesa</option>
                            <option>Tondo 1</option>
                            <option>Tondo 2</option>
                        </select>
                    </div>
                    <!-- script to add barangay -->
                    <script>
                        $(document).ready(() => {
                            for (i = 1; i <= 910; i++) {
                                $("#barangay").append($('<option>', {
                                    value: i,
                                    text: i
                                }))
                            }
                        });
                    </script>
                    <div class="col-md-4 col-10">
                        <label for="barangay">Barangay</label>
                        <select id="barangay" name="barangay" class="form-control">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="zip_code">Zip Code</label>
                        <input class="form-control" type="text" id="zip_code" name="zip_code">
                    </div>
                    <div class="col-md-3">
                        <label for="contact_no">Contact #</label>
                        <input class="form-control" type="text" id="contact_no" name="contact_no">
                    </div>
                    <div class="col-md-3">
                        <label for="email">Email Address</label>
                        <input class="form-control" type="text" id="email" name="email">
                    </div>
                </div>
                <!-- seperate -->
                <div class="row justify-content-start seperate3">
                    <div class="col-md-4 col-10">
                        <label for="mothers_name">Mother's Name</label>
                        <input type="text" class="form-control" id="mothers_name" name="mothers_name">
                    </div>
                    <div class="col-md-4 col-10">
                        <label for="mothers_contact">Mother's Contact #</label>
                        <input type="text" class="form-control" id="mothers_contact" name="mothers_contact">
                    </div>
                    <div class="col-md-4 col-10">
                        <label for="mothers_occupation">Mother's Occupation</label>
                        <input class="form-control" type="text" id="mothers_occupation" name="mothers_occupation">
                    </div>
                    <div class="col-md-4 col-10">
                        <label for="fathers_name">Father's Name</label>
                        <input type="text" class="form-control" id="fathers_name" name="fathers_name">
                    </div>
                    <div class="col-md-4 col-10">
                        <label for="fathers_contact">Father's Contact #</label>
                        <input type="text" class="form-control" id="fathers_contact" name="fathers_contact">
                    </div>
                    <div class="col-md-4 col-10">
                        <label for="fathers_occupation">Father's Occupation</label>
                        <input class="form-control" type="text" id="fathers_occupation" name="fathers_occupation">
                    </div>
                </div>
                <!-- seperate -->
                <div class="row justify-content-start seperate4">
                    <div class="col-md-6 col-10">
                        <label for="mothers_name">School Graduated before</label>
                        <input type="text" class="form-control" id="mothers_name" name="mothers_name">
                    </div>
                </div>
                <!-- seperate -->
            </form>
        </div>
    </section>
</body>
<!-- scripts for bootstrap -->
<script src="bootstrap5/js/bootstrap.bundle.min.js"></script>

</html>