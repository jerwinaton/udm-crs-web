<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universidad de Manila | Login</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- own css -->
    <link rel="stylesheet" href="css/index.css">
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
                <form action="" method="POST">
                    <h3>Login</h3>
                    <label for="username" class="align-self-start">Username</label>
                    <input type="text" id="username" name="username" required>
                    <label for="username" class="align-self-start">Password</label>
                    <input type="password" id="password" name="password" required>
                    <input type="submit" class="btn-login-submit" value="Login">
                </form>
                <?php
                require 'includes/connection.php';
                ?>
            </div>
        </div>
    </section>
    <footer>
        <p>Copyright All Right Reserved 2021</p>
        .l
    </footer>
</body>
<!-- scripts for bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>