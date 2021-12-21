<?php
require '../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username']; //username textbox
    $password = $_POST['password']; //password textbox
    $response = '<script>$("#status-msg").html("Username or Password was not found in the database.");
    $("#status-msg").addClass("login-status-msg");</script>';


    //check credentials if found in database
    try {
        $select_stmt = $conn->prepare("SELECT * FROM udm.students WHERE student_username=:uname"); //prepared selct statement
        $select_stmt->execute(array(':uname' => $username)); //execute and bind parameters
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        session_start();
        if ($row != FALSE) { //if username is found
            if (password_verify($password, $row["student_password"])) {
                $_SESSION["loggedin"] = true;
                $_SESSION["student_username"] = $row["student_username"];
                echo '<script>location.reload();</script>';
            } else {
                echo $response;
                $_SESSION["loggedin"] = false;
            }
        } else {
            echo $response;
            $_SESSION["loggedin"] = false;
        }
    } catch (PDOException $err) {
        $err->getMessage();
    }
}
