<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UDM Student Portal | Forgot Password</title>
    <!-- jquery -->
    <script src="../jquery/jquery3.6.0.min.js"></script>
    <!-- bootstrap -->
    <link rel="stylesheet" href="../bootstrap5/css/bootstrap.min.css">
    <!-- global css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- forgot password css -->
    <link rel="stylesheet" href="../css/forgot-password.css">
</head>

<body>
    <section>
        <!-- fisrt form to show , enter username -->
        <div class="this-container d-flex flex-column  align-items-center">
            <a href="../login.php" class="btn-back">&#8592; Login</a>
            <form action="" method="POST" class="forgot-password-form">
                <h3>Forgot Password</h3>
                <!--username search status message if error logging in-->
                <p id="status-msg"></p>
                <div class="inputs d-flex flex-column">
                    <input type="text" id="username" name="username" placeholder="Enter username" required>
                    <button type="submit" id="proceed">Proceed</button>
                    <script>
                        $(function() {
                            $('.forgot-password-form').on('submit', function(e) {
                                e.preventDefault();
                                $.ajax({
                                    type: 'post',
                                    url: '../queries/search-username.php',
                                    data: $('form').serialize(),
                                    beforeSend: function() {
                                        $("#proceed").html("Searching...");
                                        $("#proceed").attr('disable', 'true');
                                        console.log("Searching...");
                                    },
                                    complete: function() {
                                        $("#proceed").html("Proceed");
                                        $("#proceed").attr('disable', 'false');
                                    },
                                    success: function(response) {
                                        console.log("success");
                                        $("#status-msg").html(response);
                                        let i = 10;

                                        function timer() {

                                            i = i - 1;
                                            $("#timer").html(i + 's');
                                            if (i == 0) {
                                                $("#resend").css('display', 'block'); // to hide
                                                $("#resend-text").css('display', 'none'); // to hide
                                                clearInterval(interval)
                                            }
                                        }
                                        const interval = setInterval(timer, 1000)

                                    }
                                });

                            });

                        });
                    </script>
            </form>
            <!-- end of fisrt form to show , enter username -->
        </div>
        <!-- 2nd form to show , enter 6-digit code -->
        <div class="this-container d-flex flex-column  align-items-center">
            <form class="otp-form">
                <h3>OTP Verification</h3>
                <p>We've sent a 6-digit verification code to the email address linked to your account <span class="text-decoration-underline" id="username-text"></span>.</p>
                <p id="verify-status-msg"></p>
                <div class="inputs d-flex flex-column">
                    <input type="text" id="code" name="enteredCode" placeholder="Enter verification code" required>
                    <div class="buttons d-flex flex-row justify-content-around">
                        <a href="#" id="change-username">Change Username</a>
                        <button type="submit" id="submit">Submit</button>
                    </div>
                    <p id="resend-text" class="text-center mt-4">Resend Code in <span id="timer"></span></p>
                    <a href="#" id="resend">Resend Code <span id="timer"></span></a>

                    <script>
                        $("#resend").css('display', 'none'); // to hide
                        //resend code
                        $('#resend').click(() => {
                            $('.forgot-password-form').submit();
                            $("#resend").css('display', 'none'); // to hide
                            $("#resend-text").css('display', 'block'); // to hide
                            let j = 10;

                            function timer2() {
                                j = j - 1;
                                $("#timer").html(j + 's');
                                if (j == 0) {
                                    $("#resend").css('display', 'block'); // to hide
                                    $("#resend-text").css('display', 'none'); // to hide
                                    clearInterval(interval2)
                                }
                            }
                            const interval2 = setInterval(timer2, 1000)
                        });
                        // change usernamne button click, hide current form, show enter username form
                        $("#change-username").click(() => {
                            $(".inputs > #username").val("");
                            $(".otp-form").css("display", "none");
                            $(".forgot-password-form").css("display", "block");
                        });

                        //veerify code
                        $(function() {
                            $('.otp-form').on('submit', function(e) {
                                e.preventDefault();
                                $.ajax({
                                    type: 'post',
                                    url: '../queries/verify-code.php',
                                    data: $('form').serialize(),
                                    beforeSend: function() {
                                        $("#submit").html("Verifying...");
                                        $("#submit").attr('disable', 'true');
                                        console.log("Verifying...");
                                    },
                                    complete: function() {
                                        $("#submit").html("Proceed");
                                        $("#submit").attr('disable', 'false');
                                    },
                                    success: function(response) {

                                        $("#verify-status-msg").html(response);
                                    }
                                });

                            });

                        });
                    </script>

            </form>
        </div>
        <!-- end of 2nd form to show , enter 6-digit code -->
        <!-- 3rd page to show, reset password -->
        <div class="this-container d-flex flex-column  align-items-center">
            <form class="reset-form">
                <h3>Reset Password</h3>
                <p id="reset-status-msg"></p>
                <div class="reset-inputs d-flex flex-column">
                    <input type="password" id="pass1" name="pass1" placeholder="Enter new password" required>
                    <input type="password" id="pass2" name="pass2" placeholder="Re-enter new password" required>
                    <div class="d-flex flex-row align-items-center my-2">
                        <input class="me-2" type="checkbox" name="view-password" id="view-password">
                        <label for="view-password">Show Password</label>
                    </div>
                    <button type="submit" id="btn-reset">Reset</button>
                    <script>
                        // show password script
                        $("#view-password").on('click', function() {
                            let $pass1 = $("#pass1");
                            let $pass2 = $("#pass2");

                            if ($pass1.attr('type') === 'password') {
                                $pass1.attr('type', 'text');
                                $pass2.attr('type', 'text');
                            } else {
                                $pass1.attr('type', 'password');
                                $pass2.attr('type', 'password');
                            }
                        });
                        $(function() {
                            $('.reset-form').on('submit', function(e) {
                                e.preventDefault();
                                $.ajax({
                                    type: 'post',
                                    url: '../queries/reset-password.php',
                                    data: $('form').serialize(),
                                    beforeSend: function() {
                                        $("#btn-reset").html("Searching...");
                                        $("#btn-reset").attr('disable', 'true');
                                        console.log("Searching...");
                                    },
                                    complete: function() {
                                        $("#btn-reset").html("Proceed");
                                        $("#btn-reset").attr('disable', 'false');
                                    },
                                    success: function(response) {
                                        console.log("success");
                                        $("#reset-status-msg").html(response);

                                    }
                                });

                            });

                        });
                    </script>
            </form>
        </div>
        <!-- end of 3rd form to show, reset passsword -->
    </section>

</body>

</html>