<?php session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universidad de Manila | Login</title>
    <!-- jquery -->
    <script src="jquery/jquery3.6.0.min.js"></script>
    <!-- bootstrap -->
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
    <!-- global css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- login page css only -->
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <section>
        <div class="school-name d-flex flex-column justify-content-center align-items-center">
            <img src="assets/images/udm_logo_300px.png" alt="udm logo" height="100" width="100">
            <div class="d-flex flex-column align-items-center">
                <h3>UNIVERSIDAD DE MANILA</h3>
                <p>Former City College of Manila</p>
                <p>One Mehans Gardens, Manila, Philippines, 1000</p>
            </div>
        </div>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="login-form">
                <form action="queries/validate.php" method="POST">
                    <h3>Login</h3>
                    <!--login status message if error logging in-->
                    <p id="status-msg"></p>

                    <label for="username" class="align-self-start">Username</label>
                    <input type="text" id="username" name="username" required>
                    <label for="username" class="align-self-start">Password</label>
                    <input type="password" id="password" name="password" required>
                    <button type="submit" class="btn-login-submit" id="login" name="btn-login-submit">Login</button>
                    <script>
                        $(function() {

                            $('form').on('submit', function(e) {

                                e.preventDefault();

                                $.ajax({
                                    type: 'post',
                                    url: 'queries/validate.php',
                                    data: $('form').serialize(),
                                    beforeSend: function() {
                                        $("#login").html("Validating...");
                                        console.log("validating");
                                    },
                                    complete: function() {
                                        $("#login").html("Login");
                                    },
                                    success: function(response) {
                                        console.log("success");
                                        $("#status-msg").html(response);
                                    }
                                });

                            });

                        });
                    </script>
                </form>

            </div>
        </div>
    </section>
    <footer class="d-flex justify-content-center align-items-center">
        <p class="mb-0" style="font-size: .7rem;">Copyright &copy; All Right Reserved 2021</p>
    </footer>
</body>
<!-- scripts for bootstrap -->
<script src="bootstrap5/js/bootstrap.bundle.min.js"></script>

</html>