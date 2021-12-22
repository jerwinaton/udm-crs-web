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
    <title>UDM Student Portal | View Grades</title>
    <!-- jquery -->
    <script src="jquery/jquery3.6.0.min.js"></script>
    <!-- bootstrap -->
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
    <!-- global css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- login page css only -->
    <link rel="stylesheet" href="css/view-grades.css">
</head>

<body>
    <!-- navbar -->
    <?php include 'includes/nav.php' ?>
    <script>
        $(".view-grades-link").addClass("active-link");
    </script>

    <section class="view-grades" style="margin-top:76px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card-custom violet-gradient no-border">
                        <h1 class="text-center">Grades</h1>

                    </div>
                </div>
                <div class="col-12">
                    <p class="text-center fw-bold mt-4 active-sched">School Year: <span id="sy1"></span> | Semester: <span id="sem1"></span> </p>
                    <table class="table table-striped text-center table1"">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th>Units</th>
                                <th>Final Grade</th>
                                <th>Course Grade</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'includes/connection.php';
                            $select_stmt = $conn->prepare("SELECT * FROM udm.grades WHERE school_year='2021-2022' AND semester='1st' AND student_no=:student_username"); //prepared selct statement
                            $select_stmt->execute(array(':student_username' => $_SESSION["student_username"]));
                            while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>
                                        <td>' . $row["subject_code"] . ' </td>
                                        <td>' . $row["description"] . ' </td>
                                        <td>' . $row["units"] . ' </td>
                                        <td>' . $row["final_grade"] . ' </td>
                                        <td>' . $row["course_grade"] . ' </td>
                                        <td>' . $row["remark"] . ' </td>
                                    </tr>';
                                $school_year = $row["school_year"];
                                $semester = $row["semester"];
                            }
                            echo '<script>$("#sy1").html("' . $school_year . '");
                                            $("#sem1").html("' . $semester . '");
                                            </script>';
                            ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <!-- end of table div -->
                <div class=" col-12">
                        <p class="text-center fw-bold mt-4 old-sched">School Year: <span id="sy2">2020-2021</span> | Semester: <span id="sem2">SUMMER</span> </p>
                        <table class="table table-striped text-center table1"">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th>Units</th>
                                <th>Final Grade</th>
                                <th>Course Grade</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $select_stmt = $conn->prepare("SELECT * FROM udm.grades WHERE school_year='2020-2021' AND semester='summer' AND student_no=:student_username"); //prepared selct statement
                            $select_stmt->execute(array(':student_username' => $_SESSION["student_username"]));
                            while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>
                                        <td>' . $row["subject_code"] . ' </td>
                                        <td>' . $row["description"] . ' </td>
                                        <td>' . $row["units"] . ' </td>
                                        <td>' . $row["final_grade"] . ' </td>
                                        <td>' . $row["course_grade"] . ' </td>
                                        <td>' . $row["remark"] . ' </td>
                                    </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <!-- end of table div -->
                <div class=" col-12">
                            <p class="text-center fw-bold mt-4 old-sched">School Year: <span id="sy3"></span> | Semester: <span id="sem3"></span> </p>
                            <table class="table table-striped text-center table1"">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th>Units</th>
                                <th>Final Grade</th>
                                <th>Course Grade</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $select_stmt = $conn->prepare("SELECT * FROM udm.grades WHERE school_year='2020-2021' AND semester='2nd' AND student_no=:student_username"); //prepared selct statement
                            $select_stmt->execute(array(':student_username' => $_SESSION["student_username"]));
                            while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>
                                        <td>' . $row["subject_code"] . ' </td>
                                        <td>' . $row["description"] . ' </td>
                                        <td>' . $row["units"] . ' </td>
                                        <td>' . $row["final_grade"] . ' </td>
                                        <td>' . $row["course_grade"] . ' </td>
                                        <td>' . $row["remark"] . ' </td>
                                    </tr>';
                                $school_year = $row["school_year"];
                                $semester = $row["semester"];
                            }
                            echo '<script>$("#sy3").html("' . $school_year . '");
                                            $("#sem3").html("' . $semester . '");
                                            </script>'; ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <!-- end of table div -->
                <div class=" col-12">
                                <p class="text-center fw-bold mt-4 old-sched">School Year: <span id="sy4"></span> | Semester: <span id="sem4"></span> </p>
                                <table class="table table-striped text-center table1"">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th>Units</th>
                                <th>Final Grade</th>
                                <th>Course Grade</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $select_stmt = $conn->prepare("SELECT * FROM udm.grades WHERE school_year='2020-2021' AND semester='1st' AND student_no=:student_username"); //prepared selct statement
                            $select_stmt->execute(array(':student_username' => $_SESSION["student_username"]));
                            while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>
                                        <td>' . $row["subject_code"] . ' </td>
                                        <td>' . $row["description"] . ' </td>
                                        <td>' . $row["units"] . ' </td>
                                        <td>' . $row["final_grade"] . ' </td>
                                        <td>' . $row["course_grade"] . ' </td>
                                        <td>' . $row["remark"] . ' </td>
                                    </tr>';
                                $school_year = $row["school_year"];
                                $semester = $row["semester"];
                            }
                            echo '<script>$("#sy4").html("' . $school_year . '");
                                            $("#sem4").html("' . $semester . '");
                                            </script>';

                            ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <!-- end of table div -->
            </div>
        </div>
    </section>
    <footer class=" d-flex justify-content-center align-items-center">
                                    <p class="mb-0" style="font-size: .7rem;">Copyright &copy; UDM|CRS All Right Reserved 2021</p>
                                    </footer>
</body>
<!-- scripts for bootstrap -->
<script src=" bootstrap5/js/bootstrap.bundle.min.js">
</script>

</html>