<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION["user_login"])) { //check session if the user is already logged in
        header("location: index.php");
    }
    $username = $_POST['username']; //username textbox
    $response = '<script>$("#status-msg").html("Username was not found in the database.");
    $("#status-msg").addClass("status-msg-style");</script>';

    //check credentials if found in database
    try {
        $select_stmt = $conn->prepare("SELECT first_name,email,student_username FROM udm.students WHERE student_username=:uname"); //prepared selct statement
        $select_stmt->execute(array(':uname' => $username)); //execute and bind parameters
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) { //if username is found\

            session_start();
            $response = '<script> $(".otp-form").css("display", "block");
            $(".forgot-password-form").css("display", "none");</script>';
            $_SESSION["student_username"] = $row["student_username"];
            $_SESSION["student_name"] = ucfirst($row["first_name"]);
            $_SESSION["student_email"] = $row["email"];
            echo $response;
            //sendEmail($conn); //send email function
        } else {
            echo "fetch failed";
        }
    } catch (PDOException $err_select) {
        $err_select->getMessage();
    }
}
function sendEmail($conn)
{
    $otp = rand(1, 999999); //create 6 digit code

    // 3 mins expiration
    $expFormat = mktime(
        date("H"),
        date("i") + 3,
        date("s"),
        date("m"),
        date("d"),
        date("Y")
    );
    // set email style
    $content = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <style type="text/css">
            @import url("https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Poppins:ital@0;1&display=swap");
         </style>
    </head>
         <body>
                <h3>UNIVERSIDAD DE MANILA</h3>
                <p>Former City College of Manila</p>
                <p>One Mehans Gardens, Manila, Philippines, 1000</p>

        <p1>Use this 6-digit code to <b>reset your password.</b></p1>
        <h1>' . $otp . '</h1>
        <p2>This code will expire in 3 minutes</p2>
    
    </body>
    </html>';
    // end of email style
    $expDate = date("Y-m-d H:i:s", $expFormat);

    try {
        $update_stmt = $conn->prepare("UPDATE udm.students SET otp=:otp, expDate=:expDate WHERE student_username=:username"); //prepared update statement
        if ($update_stmt->execute(array(':otp' => strval($otp), ':expDate' => $expDate, ':username' => $_SESSION["student_username"]))) {
            echo "updated";
            require '../vendor/phpmailer/phpmailer/src/Exception.php';
            require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
            require '../vendor/phpmailer/phpmailer/src/SMTP.php';
            $mail = new PHPMailer();

            $mail->CharSet =  "utf-8";
            $mail->IsSMTP();
            // enable SMTP authentication
            $mail->SMTPAuth = true;
            // GMAIL username
            $mail->Username = "udm.crs.web@gmail.com";
            // GMAIL password
            $mail->Password = "#udmcrsweb";
            $mail->SMTPSecure = "ssl";
            // sets GMAIL as the SMTP server
            $mail->Host = "smtp.gmail.com";
            // set the SMTP port for the GMAIL server
            $mail->Port = "465";
            $mail->From = 'udm.crs.web@gmail.com';
            $mail->FromName = 'Universidad de Manila CRS';
            $mail->AddAddress($_SESSION["student_email"], $_SESSION["student_name"]);
            $mail->Subject  =  'OTP Code - Universidad de Manila CRS';
            $mail->IsHTML(true);
            $mail->Body    = $content;
            $mail->send(); //send
            // if ($mail->Send()) {
            //     echo "Check Your Email and Click on the link sent to your email";
            // } else {
            //     echo "Mail Error - >" . $mail->ErrorInfo;
            // }
        } else {
            echo "update failed";
        }
    } catch (PDOException $err_update) {
        $err_update->getMessage();
    }
}
