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
        <div class="this-container d-flex flex-column  align-items-center">
            <a href="../login.php" class="btn-back">&#8592; Back</a>
            <form action="" method="POST" class="forgot-password-form">
                <h3>Forgot Password</h3>
                <!--username search status message if error logging in-->
                <p id="status-msg"></p>
                <div class="inputs d-flex flex-column">
                    <input type="text" id="username" name="username" placeholder="Enter username" required>
                    <button type="submit" id="proceed">Proceed</button>
                    <script>
                        $(function() {
                            $('form').on('submit', function(e) {
                                e.preventDefault();
                                $.ajax({
                                    type: 'post',
                                    url: '../queries/search-username.php',
                                    data: $('form').serialize(),
                                    beforeSend: function() {
                                        $("#proceed").html("Searching...");
                                        console.log("Searching...");
                                    },
                                    complete: function() {
                                        $("#proceed").html("Proceed");
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
        <div class="this-container d-flex flex-column  align-items-center">
            <form class="otp-form">
                <h3>OTP Verification</h3>
                <p>We've sent a 6-digit verification code to the email address linked to your account.</p>
                <div class="inputs d-flex flex-column">
                    <input type="text" id="username" placeholder="Enter verification code" required>
                    <div class="buttons d-flex flex-row justify-content-around">
                        <a href="#" id="change-username">Change Username</a>
                        <button type="submit">Proceed</button>
                    </div>
                    <p id="resend-text" class="text-center mt-4">Resend Code in <span id="timer"></span></p>
                    <a href="#" id="resend">Resend Code <span id="timer"></span></a>

                    <script>
                        $("#resend").css('display', 'none'); // to hide
                        let i = 3;

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


                        // $("#change-username").click(() => {
                        // $(".otp-form").css("display", "none");
                        // $(".forgot-password-form").css("display", "block");
                        // });
                    </script>

            </form>
        </div>
        </div>
    </section>

</body>

</html>