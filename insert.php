<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST">
        <input type="text" name="password">
        <input type="submit" value="asd" name="btn">
    </form>
    <?php
    require 'includes/connection.php';


    if (isset($_POST['btn'])) {
        $password = $_POST['password']; //password textbox
        $options = ['cost' => 4];
        $hashedP = password_hash($password, PASSWORD_BCRYPT, $options);
        $hashedP = trim($hashedP);
        $select_stmt = $conn->prepare("UPDATE udm.students SET student_password=:pass WHERE student_id=:id"); //prepared selct statement
        if ($select_stmt->execute(array(':pass' => $hashedP, ':id' => 1))) {
            echo $hashedP;
            echo "success";
        } //execute and bind parameters
    }
    ?>
</body>

</html>