<?php
include '../includes/connection.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $response = '<script>$("#change-status-msg").html("Passwords not matched!.");
    $("#change-status-msg").addClass("status-msg-style");</script>';

    $pass1 =  $_POST["pass1"]; //get pass1
    $pass2 =  $_POST["pass2"]; //get password2

    if ($pass1 != $pass2) { //if passwords don't match, don't reset, return error
        echo $response;
    } else if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W\_])[A-Za-z\d\W\_]{8,}$/", $pass1)) {
        echo '<script>$("#change-status-msg").html("Password does not meet the requirements!");
        $("#change-status-msg").addClass("status-msg-style");</script>';
    } else {
        // update password
        try {
            $password = $_POST['pass1']; //password textbox
            $options = ['cost' => 4];
            $hashedP = password_hash($password, PASSWORD_BCRYPT, $options);
            $hashedP = trim($hashedP);
            $update_stmt = $conn->prepare("UPDATE udm.students SET student_password=:pass WHERE student_username=:username"); //prepared selct statement
            if ($update_stmt->execute(array(':pass' => $hashedP, ':username' => $_SESSION["student_username"]))) {
                $response = '<script>$("#change-status-msg").html("Password reset is successful.");
                $("#change-status-msg").removeClass("status-msg-style");
                $("#change-status-msg").addClass("success-status-msg-style");
                $("#pass2").css("display","none"); 
                $("#btn-reset").css("display","none"); 
                $("#pass1").css("display","none"); 
                $(".show-pass > input").css("display","none"); 
                $(".show-pass > label").css("display","none"); 
                $(".change-password-form > p").css("display","none");
                $(".change-password-form").css("margin-top","80px");
                $("#btn-change").css("display","none");
                </script>';
                echo $response;
            } //execute and bind parameters

        } catch (PDOException $err_select) {
            $err_select->getMessage();
        }
    }
    // end of password else


}//end if server
