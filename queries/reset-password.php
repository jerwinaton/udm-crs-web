<?php
include '../includes/connection.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION["loggedin"])) { //check session if the user is already logged in
        header("location: index.php");
    }

    $response = '<script>$("#reset-status-msg").html("Passwords not matched!.");
    $("#reset-status-msg").addClass("status-msg-style");</script>';

    $pass1 =  $_POST["pass1"]; //get pass1
    $pass2 =  $_POST["pass2"]; //get password2

    if ($pass1 != $pass1) { //if passwords don't match, don't reset, return error
        echo $response;
    } else {
        // update password
        try {
            $password = $_POST['pass1']; //password textbox
            $options = ['cost' => 4];
            $hashedP = password_hash($password, PASSWORD_BCRYPT, $options);
            $hashedP = trim($hashedP);
            $update_stmt = $conn->prepare("UPDATE udm.students SET student_password=:pass WHERE student_username=:username"); //prepared selct statement
            if ($update_stmt->execute(array(':pass' => $hashedP, ':username' => $_SESSION["student_username"]))) {
                echo "success";
            } //execute and bind parameters

        } catch (PDOException $err_select) {
            $err_select->getMessage();
        }
    }
    // end of password else


}//end if server
