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
                            $('#first_name').val(value.first_name).attr("disabled", "true").css("text-transform", "uppercase");
                            $('#middle_name').val(value.middle_name).attr("disabled", "true").css("text-transform", "uppercase");
                            $('#last_name').val(value.last_name).attr("disabled", "true").css("text-transform", "uppercase");
                            $('#lrn').val(value.lrn).attr("disabled", "true").css("text-transform", "uppercase");
                            $('#gender').val(value.gender).attr("disabled", "true").css("text-transform", "uppercase");
                            $('#birthdate').val(value.birthdate).attr("disabled", "true").css("text-transform", "uppercase");
                            $('#birthplace').val(value.birthplace).attr("disabled", "true").css("text-transform", "uppercase");
                            $('#address').val(value.address).attr("disabled", "true").css("text-transform", "uppercase");
                            $('#district').val(value.district).attr("disabled", "true").css("text-transform", "uppercase");
                            $('#town').val(value.town).attr("disabled", "true").css("text-transform", "uppercase");
                            $('#barangay').val(value.barangay).attr("disabled", "true").css("text-transform", "uppercase");
                            $('#zip_code').val(value.zip_code).attr("disabled", "true").css("text-transform", "uppercase");
                            $('#contact_no').val(value.contact_no).attr("disabled", "true").css("text-transform", "uppercase");
                            $('#email').val(value.email).attr("disabled", "true").css("text-transform", "lowercase");
                            $('#mothers_name').val(value.mothers_name).attr("disabled", "true").css("text-transform", "uppercase");
                            $('#mothers_contact').val(value.mothers_contact_no).attr("disabled", "true").css("text-transform", "uppercase");
                            $('#mothers_occupation').val(value.mothers_work).attr("disabled", "true").css("text-transform", "uppercase");
                            $('#fathers_name').val(value.fathers_name).attr("disabled", "true").css("text-transform", "uppercase");
                            $('#fathers_contact').val(value.fathers_contact_no).attr("disabled", "true").css("text-transform", "uppercase");
                            $('#fathers_occupation').val(value.fathers_work).attr("disabled", "true").css("text-transform", "uppercase");
                            $('#last_school_attended').val(value.last_school_attended).attr("disabled", "true").css("text-transform", "uppercase");
                        });
                    }
                });
            }
            load(); //call the load
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
            // save
            $('#save').on('click', function(e) {
                e.preventDefault();
                $('.profile-form').submit();

                $.ajax({
                    type: 'post',
                    url: 'queries/edit-profile.php',
                    data: $('form').serialize(),
                    beforeSend: function() {
                        $("#save").html("Updating...");
                        console.log("Updating");
                    },
                    complete: function() {
                        $("#save").html("Save");
                    },
                    success: function(response) {
                        load();
                        $("#edit").css("display", "block");
                        $("#save").css("display", "none");
                        $("#cancel").css("display", "none");
                        $("#status-msg").html(response);
                        var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
                            keyboard: false
                        })
                        myModal.show();
                    }
                });

            });
        });
    </script>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body d-flex flex-column justify-content-center">
                    <p class="text-center fw-bold">Your profile has been updated.</p>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <section class="edit-profile">

        <div class="container-form">
            <form action="" class="profile-form">
                <div class="floating-buttons d-flex flex-row">
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
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
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
                            <option value="binondo">Binondo </option>
                            <option value="ermita">Ermita </option>
                            <option value="intramuros">Intramuros </option>
                            <option value="malate">Malate </option>
                            <option value="paco">Paco </option>
                            <option value="pandacan">Pandacan </option>
                            <option value="port area">Port Area </option>
                            <option value="quiapo">Quiapo </option>
                            <option value="sampaloc">Sampaloc </option>
                            <option value="san andres">San Andres </option>
                            <option value="san miguel">San Miguel </option>
                            <option value="san nicolas">San Nicolas </option>
                            <option value="santa ana">Santa Ana </option>
                            <option value="santa cruz">Santa Cruz </option>
                            <option value="santa mesa">Santa Mesa </option>
                            <option value="tondo 1">Tondo 1 </option>
                            <option value="tondo 2">Tondo 2 </option>
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