<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $username = $_POST['username']; //username textbox
  $response = '<script>$("#status-msg").html("Username was not found in the database.");
    $("#status-msg").addClass("status-msg-style");</script>';

  //check credentials if found in database
  try {
    $select_stmt = $conn->prepare("SELECT first_name,email,student_username FROM xyashmqn_udm.students WHERE student_username=:uname"); //prepared selct statement
    $select_stmt->execute(array(':uname' => $username)); //execute and bind parameters
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) { //if username is found\

      session_start();
      //set session variables
      $_SESSION["student_username"] = $row["student_username"];
      $_SESSION["student_name"] = ucfirst($row["first_name"]);
      $_SESSION["student_email"] = $row["email"];

      $response = '<script> $(".otp-form").css("display", "block");
            $(".forgot-password-form").css("display", "none");
            $("#username-text").html("' . $_SESSION["student_username"] . '");
            </script>';
      echo $response;
      sendEmail($conn); //get email credentials from database

    } else {
      echo $response;
    }
  } catch (PDOException $err_select) {
    $err_select->getMessage();
  }
}

function sendEmail($conn)
{
  $otp = rand(1, 999999); //create 6 digit code
  date_default_timezone_set("Asia/Manila"); //set timezome to manila
  // 5 mins expiration
  $expFormat = mktime(
    date("H"),
    date("i") + 5,
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
  
          table {
              max-width: 500px;
              margin: auto auto;
              text-align: center;
              font-family: Poppins, sans-serif;
              border-collapse: collapse;
          }
      </style>
  </head>
  <table bgcolor="white">
      <tr>
          <td bgcolor="#0B6B09" style="color: white; padding: 0 40px">
              <p style="
              font-family: DM Serif Display, serif;
              font-size: 30px;
              margin-top: 20px;
              margin-bottom: 0px;
            ">
                  UNIVERSIDAD DE MANILA
              </p>
          </td>
      </tr>
      <tr>
          <td bgcolor="#0B6B09">
              <p style="
              color: white;
              margin-bottom: 20px;
              margin-top: 0px;
              font-size: 12px;
            ">
                  Former City College of Manila<br />One Mehans Gardens, Manila,
                  Philippines, 1000
              </p>
          </td>
      </tr>
      <tr>
          <td>
              <p style="margin-top: 20px">
                  Use this 6-digit code to <b>reset your password.</b>
              </p>
          </td>
      </tr>
      <tr>
          <td>
              <h1>' . $otp . '</h1>
          </td>
      </tr>
      <tr>
          <td>
              <p style="margin-bottom: 50px">This code will expire in 5 minutes</p>
          </td>
      </tr>
      <tr>
          <td style="padding: 10px 0; background: rgb(215, 224, 220)">
              <a href="https://udm.edu.ph/udm2/" target="_blank" style="margin-right: 30px; color: #0b6b09">udm.edu.ph</a>
              <a href="https://web.facebook.com/udmanila" target="_blank" style="color: #0b6b09">fb: udmmanila</a>
          </td>
      </tr>
  </table>
  
  <body></body>
  
  </html>';
  // end of email style
  $expDate = date("Y-m-d H:i:s", $expFormat);
  try {
    $update_stmt = $conn->prepare("UPDATE xyashmqn_udm.students SET otp=:otp, expDate=:expDate WHERE student_username=:username"); //prepared update statement
    if ($update_stmt->execute(array(':otp' => strval($otp), ':expDate' => $expDate, ':username' => $_SESSION["student_username"]))) {
      require '../vendor/phpmailer/phpmailer/src/Exception.php';
      require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
      require '../vendor/phpmailer/phpmailer/src/SMTP.php';
      $mail = new PHPMailer(true);

      $mail->CharSet =  "utf-8";
      $mail->IsSMTP();
      // enable SMTP authentication
      $mail->SMTPAuth = true;
      // GMAIL username
      $mail->Username = "udm.crs.web@gmail.com";
      // GMAIL password
      $mail->Password = '#udmcrsweb2021';
      $mail->SMTPSecure = "ssl";
      $mail->SMTPDebug = true;
      // sets GMAIL as the SMTP server
      $mail->Host = "smtp.gmail.com";
      // set the SMTP port for the GMAIL server
      $mail->Port = "465";
      $mail->From = 'udm.crs.web@gmail.com';
      $mail->FromName = 'Universidad de Manila CRS';
      $mail->AddAddress($_SESSION["student_email"], $_SESSION["student_name"]);
      $mail->Subject  =  'Reset Password - Universidad de Manila CRS';
      $mail->IsHTML(true);
      $mail->Body = $content;
      if ($mail->send()) { //send
        echo '<script>console.log("email sent")</script>';
      } else {
        echo '<script>console.log("email not sent")</script>';
      }
    } else {
      echo "email failed";
    }
  } catch (PDOException $err_update) {
    $err_update->getMessage();
  }
}
