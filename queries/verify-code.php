<?php
include '../includes/connection.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username =  $_SESSION["student_username"]; //username variable on session
    $enteredCode =  $_POST["enteredCode"];
    $response = '<script>$("#verify-status-msg").html("Code is invalid or expired.");
    $("#verify-status-msg").addClass("status-msg-style");</script>';
    //verify code
    try {
        $select_stmt = $conn->prepare("SELECT otp, expDate FROM udm.students WHERE student_username=:uname"); //prepared selct statement
        $select_stmt->execute(array(':uname' => $username)); //execute and bind parameters
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) { //if username is found\
            //verify if expired or not
            $expFormat = mktime(
                date("H"),
                date("i"),
                date("s"),
                date("m"),
                date("d"),
                date("Y")
            );
            $expDate = date("Y-m-d H:i:s", $expFormat);
            if ($row["expDate"] < $expDate) {
                echo $response;
            } else { //if not expired
                if ($enteredCode == $row["otp"]) {
                    $response = '<script> $(".reset-form").css("display", "block");
                     $(".otp-form").css("display", "none");
                      </script>';
                    echo $response;
                } else {
                    echo $response;
                }
            }
        } else {
            echo "fetch failed";
        }
    } catch (PDOException $err_select) {
        $err_select->getMessage();
    }
}//end if server
