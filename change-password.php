<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UDM Student Portal | Change Password</title>
    <!-- jquery -->
    <script src="jquery/jquery3.6.0.min.js"></script>
    <!-- bootstrap -->
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
    <!-- global css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- login page css only -->
    <link rel="stylesheet" href="css/change-password.css">
</head>

<body>
    <?php include 'includes/nav.php'; ?>
    <!-- script to add style on current link -->
    <script>
        $(".password-link").addClass("active-link");
    </script>
    <section class="change-password">
        <div class="this-container d-flex flex-column  align-items-center">
            <form class="change-password-form">
                <h3> Change Password</h3>
                <p>Password must be at least 8 characters or longer.</p>
                <p>At least one uppercase (A-Z) and one lowercase (a-z).</p>
                <p>At least one number (0-9) and symbol like (@$!%*#?&).</p>
                <span id="change-status-msg"></span>
                </p>
                <div class="reset-inputs d-flex flex-column">
                    <input type="password" id="pass1" name="pass1" placeholder="Enter new password" required>
                    <input type="password" id="pass2" name="pass2" placeholder="Re-enter new password" required>
                    <div class="d-flex show-pass flex-row align-items-center my-2">
                        <input class="me-2" type="checkbox" name="view-password" id="view-password">
                        <label for="view-password">Show Password</label>
                    </div>
                    <button type="submit" id="btn-change">Change</button>
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
                            $('.change-password').on('submit', function(e) {
                                e.preventDefault();
                                $.ajax({
                                    type: 'post',
                                    url: 'queries/change-password.php',
                                    data: $('form').serialize(),
                                    beforeSend: function() {
                                        $("#btn-change").html("Validating...");
                                        $("#btn-change").attr('disable', 'true');
                                    },
                                    complete: function() {
                                        $("#btn-change").html("Change");
                                        $("#btn-change").attr('disable', 'false');
                                    },
                                    success: function(response) {
                                        console.log("success");
                                        $("#change-status-msg").html(response);

                                    }
                                });

                            });

                        });
                    </script>
            </form>
        </div>
    </section>
</body>
<!-- scripts for bootstrap -->
<script src="bootstrap5/js/bootstrap.bundle.min.js"></script>

</html>