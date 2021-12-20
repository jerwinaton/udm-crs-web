*<?php
    // Initialize the session
    session_start();
    if (isset($_POST['btn-logout'])) {
        // Unset all of the session variables fot the user session only,
        //so if the user account is logged out, admin account wont be logged out (if it is logged in)

        unset($_SESSION["loggedin"], $_SESSION["student_username"], $_SESSION["email"], $_SESSION["student_name"]);
        // Redirect to login page
        header("location: ../login.php");
        exit;
    } else {
        header("location: ../index.php");
    }
    ?>