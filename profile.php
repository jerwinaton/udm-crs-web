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
                            <p>Student No: <span id="student_no"><?= $student_no ?></span></p>
                            <p>Student Name: <span><?= $student_name ?></span></p>
                            <p>Course: <span><?= $course ?></span></p>
                            <p>College: <span><?= $college ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- script to load profile -->
    <script>
        $(document).ready(() => {
            const load = () => {
                const id = $('#student_no').text();
                $.ajax({
                    url: "queries/load-profile.php",
                    method: "POST",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $.each(response, function(key, value) {
                            console.log(value.first_name);
                            $('#first_name').val(value.first_name).attr("disabled", "true");
                            $('#middle_name').val(value.middle_name).attr("disabled", "true");
                            $('#last_name').val(value.last_name).attr("disabled", "true");
                            $('#lrn').val(value.lrn).attr("disabled", "true");
                            $('#gender').val(value.gender).attr("disabled", "true");
                            $('#birthdate').val(value.birthdate).attr("disabled", "true");
                            $('#birthplace').val(value.birthplace).attr("disabled", "true");
                            $('#address').val(value.address).attr("disabled", "true");
                            $('#district').val(value.district).attr("disabled", "true");
                            $('#town').val(value.town).attr("disabled", "true");
                            $('#barangay').val(value.barangay).attr("disabled", "true");
                            $('#zip_code').val(value.zip_code).attr("disabled", "true");
                            $('#contact_no').val(value.contact_no).attr("disabled", "true");
                            $('#email').val(value.email).attr("disabled", "true");
                            $('#mothers_name').val(value.mothers_name).attr("disabled", "true");
                            $('#mothers_contact').val(value.mothers_contact).attr("disabled", "true");
                            $('#mothers_occupation').val(value.mothers_work).attr("disabled", "true");
                            $('#fathers_name').val(value.fathers_name).attr("disabled", "true");
                            $('#fathers_contact').val(value.fathers_contact).attr("disabled", "true");
                            $('#fathers_occupation').val(value.fathers_work).attr("disabled", "true");
                            $('#last_school_attended').val(value.last_school_attended).attr("disabled", "true");
                        });
                    }
                });
            }
            load();
            $("#edit").click((e) => {
                e.preventDefault();
                $('#first_name').removeAttr("disabled");
                $('#middle_name').removeAttr("disabled");
                $('#last_name').removeAttr("disabled");
                $('#lrn').removeAttr("disabled");
                $('#gender').removeAttr("disabled");
                $('#birthdate').removeAttr("disabled");
                $('#birthplace').removeAttr("disabled");
                $('#address').removeAttr("disabled");
                $('#district').removeAttr("disabled");
                $('#town').removeAttr("disabled");
                $('#barangay').removeAttr("disabled");
                $('#zip_code').removeAttr("disabled");
                $('#contact_no').removeAttr("disabled");
                $('#email').removeAttr("disabled");
                $('#mothers_name').removeAttr("disabled");
                $('#mothers_contact').removeAttr("disabled");
                $('#mothers_occupation').removeAttr("disabled");
                $('#fathers_name').removeAttr("disabled");
                $('#fathers_contact').removeAttr("disabled");
                $('#fathers_occupation').removeAttr("disabled");
                $('#last_school_attended').removeAttr("disabled");

                $("#edit").css("display", "none");
                $("#save").css("display", "block");
                $("#cancel").css("display", "block");
            });
            // cancel
            $("#cancel").click((e) => {
                e.preventDefault();
                load();
                $("#edit").css("display", "block");
                $("#save").css("display", "none");
                $("#cancel").css("display", "none");
            });
        });
    </script>
    <section class="edit-profile">

        <div class="container-form">
            <form action="" class="profile-form">
                <div class="floating-buttons">
                    <button id="edit">Edit</button>
                    <button type="submit" id="save">Save</button>
                    <button id="cancel">Cancel</button>
                </div>
                <div class="row justify-content-start seperate1">
                    <div class="col-md-4 col-sm-6">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name">
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name">
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <label for="last_name">Last Name</label>
                        <input class="form-control" type="text" id="last_name" name="last_name">
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <label for="lrn">LRN</label>
                        <input class="form-control" type="text" id="lrn" name="lrn">
                    </div>
                    <div class="col-md-2 col-sm-4 col-6">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" class="form-control">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-4 col-6">
                        <label for="birthdate">Birthdate</label>
                        <input class="form-control" type="date" id="birthdate" name="birthdate">
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <label for="birthplace">Birthplace</label>
                        <input class="form-control" type="birthplace" id="birthplace" name="birthplace">
                    </div>
                </div>
                <!-- seperate -->
                <div class="row justify-content-start seperate2">
                    <div class="col-md-4 col-sm-6">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="col-md-4 col-sm-2 col-4">
                        <label for="district">District</label>
                        <select id="district" name="district" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-4 col-4">
                        <label for="town">Town</label>
                        <select id="town" name="town" class="form-control">
                            <option value="Binondo">Binondo </option>
                            <option value="Ermita">Ermita </option>
                            <option value="Intramuros">Intramuros </option>
                            <option value="Malate">Malate </option>
                            <option value="Paco">Paco </option>
                            <option value="Pandacan">Pandacan </option>
                            <option value="Port Area">Port Area </option>
                            <option value="Quiapo">Quiapo </option>
                            <option value="Sampaloc">Sampaloc </option>
                            <option value="San Andres">San Andres </option>
                            <option value="San Miguel">San Miguel </option>
                            <option value="San Nicolas">San Nicolas </option>
                            <option value="Santa Ana">Santa Ana </option>
                            <option value="Santa Cruz">Santa Cruz </option>
                            <option value="Santa Mesa">Santa Mesa </option>
                            <option value="Tondo 1">Tondo 1 </option>
                            <option value="Tondo 2">Tondo 2 </option>
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
                    <div class="col-md-4 col-sm-3 col-4">
                        <label for="barangay">Barangay</label>
                        <select id="barangay" name="barangay" class="form-control">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-3 col-4">
                        <label for="zip_code">Zip Code</label>
                        <input class="form-control" type="text" id="zip_code" name="zip_code">
                    </div>
                    <div class="col-md-3 col-sm-4 col-8">
                        <label for="contact_no">Contact #</label>
                        <input class="form-control" type="text" id="contact_no" name="contact_no">
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <label for="email">Email Address</label>
                        <input class="form-control" type="text" id="email" name="email">
                    </div>
                </div>
                <!-- seperate -->
                <div class="row justify-content-start seperate3">
                    <div class="col-md-4 col-sm-4">
                        <label for="mothers_name">Mother's Name</label>
                        <input type="text" class="form-control" id="mothers_name" name="mothers_name">
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label for="mothers_contact">Mother's Contact #</label>
                        <input type="text" class="form-control" id="mothers_contact" name="mothers_contact">
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label for="mothers_occupation">Mother's Occupation</label>
                        <input class="form-control" type="text" id="mothers_occupation" name="mothers_occupation">
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label for="fathers_name">Father's Name</label>
                        <input type="text" class="form-control" id="fathers_name" name="fathers_name">
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label for="fathers_contact">Father's Contact #</label>
                        <input type="text" class="form-control" id="fathers_contact" name="fathers_contact">
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label for="fathers_occupation">Father's Occupation</label>
                        <input class="form-control" type="text" id="fathers_occupation" name="fathers_occupation">
                    </div>
                </div>
                <!-- seperate -->
                <div class="row justify-content-start seperate4">
                    <div class="col-md-6 col-10">
                        <label for="last_school_attended">School Graduated before</label>
                        <input type="text" class="form-control" id="last_school_attended" name="last_school_attended">
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