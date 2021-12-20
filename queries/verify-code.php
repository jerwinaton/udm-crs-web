<?php
include '../includes/connection.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION["loggedin"])) { //check session if the user is already logged in
        header("location: index.php");
    }
    $username =  $_SESSION["student_username"]; //username variable on session
    $enteredCode =  $_POST["enteredCode"];
    $response = '<script>$("#verify-status-msg").html("Code is invalid.");
    $("#verify-status-msg").addClass("status-msg-style");</script>';
    //verify code
    try {
        $select_stmt = $conn->prepare("SELECT otp, expDate FROM udm.students WHERE student_username=:uname"); //prepared selct statement
        $select_stmt->execute(array(':uname' => $username)); //execute and bind parameters
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) { //if username is found\
            if ($enteredCode == $row["otp"]) {
                $response = '<script> $(".reset-form").css("display", "block");
                 $(".otp-form").css("display", "none");
                  </script>';
                echo $response;
            } else {
                echo $response;
            }
        } else {
            echo "fetch failed";
        }
    } catch (PDOException $err_select) {
        $err_select->getMessage();
    }
}//end if server
