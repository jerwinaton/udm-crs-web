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
            echo "fetched";
            session_start();
            $response = '<script> $(".otp-form").css("display", "block");
            $(".forgot-password-form").css("display", "none");</script>';
            $_SESSION["student_username"] = $row["student_username"];
            $_SESSION["student_name"] = ucfirst($row["first_name"]);
            $_SESSION["student_email"] = $row["email"];
            echo $response;

            // sendEmail($conn); //send email function
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style type="text/css">
            @import url("https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Poppins:ital@0;1&display=swap");
            body{
                max-width: 600px;
                margin-inline: auto;
                display: flex;
                flex-direction: column;
                justify-content-center;
            }
            header {
                display: flex;
                flex-direction: row;
                justify-content: center;
                background: #0B6B09;
                padding: 10px;
                color: white;
            }
    
            div {
                display: flex;
                flex-direction: column;
            }
    
            h3 {
                font-family: "DM Serif Display", serif;
                margin: 0;
            }
    
            p {
                font-family: Poppins, sans-serif;
                margin: 0;
                font-size: .8rem
            }
    
            img {
                margin-right: 5px;
            }
    
            /* body*/
            h1 {
                padding: 20px;
                border: 1px solid #0B6B09;
                text-align: center;
                background: #f0fff3;
                max-width: 300px;
                margin-inline: auto;
            }
    
            p1,
            p2 {
                text-align: center;
                margin: 20px;
                display: block;
                font-size: 1rem;
                font-family: Poppins, sans-serif;
            }
    
            footer {
                padding: 20px;
                display: flex;
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
                font-family: Poppins, sans-serif;
            }
    
            footer {
                width: 100%;
                margin-top: 30px;
            }
    
            footer>div .logo-text {
                display: flex;
                flex-direction: column;
            }
    
            footer>div>.logo-text {
                font-size: 3px;
            }
        </style>
    </head>
    <body>
        <header>
            <img src="../assets/images/udm_logo_300px.png" width="70px" height="70px">
            <div>
                <h3>UNIVERSIDAD DE MANILA</h3>
                <p>Former City College of Manila</p>
                <p>One Mehans Gardens, Manila, Philippines, 1000</p>
                <div>
        </header>
    
        <p1>Use this 6-digit code to <b>reset your password.</b></p1>
        <h1>' . $otp . '</h1>
        <p2>This code will expire in 3 minutes</p2>
    
    <footer>
        <div>
            <a style="display:flex; flex-direction: row; text-decoration: none; color: #333333;"href="https://udm.edu.ph/udm2/" target="_blank">
                <img src="../assets/images/udm_logo_300px.png" width="30px" height="30px">
                <div class="logo-text">
                    <h3 style="font-size: .8rem;">UNIVERSIDAD DE MANILA</h3>
                    <p style="font-size: .7rem;">Former City College of Manila</p>
                </div>
            </a>
        </div>
        <div><a style="text-decoration: none;font-size:1rem; color: #333333;font-style:normal;" href="https://web.facebook.com/udmanila" target="_blank"><i class="fab fa-facebook"></i> facebook</a></div>
    </footer>
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
            $mail->AddAddress('jerwin.mathew28@gmail.com', $_SESSION["student_name"]);
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
